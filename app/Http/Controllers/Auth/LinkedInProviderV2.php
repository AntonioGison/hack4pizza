<?php

namespace Laravel\Socialite\Two;

use Illuminate\Support\Arr;

class LinkedInProvider extends AbstractProvider implements ProviderInterface
{
    /**
     * The scopes being requested.
     *
     * @var array
     */
    protected $scopes = ['r_liteprofile', 'r_emailaddress'];

    /**
     * The separating character for the requested scopes.
     *
     * @var string
     */
    protected $scopeSeparator = ' ';

    /**
     * The fields that are included in the profile.
     *
     * @var array
     */
    protected $fields = [
        'id', 'firstName', 'lastName', 'profilePicture(displayImage~:playableStreams)', 'emailAddress'
    ];

    /**
     * {@inheritdoc}
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase('https://www.linkedin.com/oauth/v2/authorization', $state);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenUrl()
    {
        return 'https://www.linkedin.com/oauth/v2/accessToken';
    }

    /**
     * Get the POST fields for the token request.
     *
     * @param  string  $code
     * @return array
     */
    protected function getTokenFields($code)
    {
        return parent::getTokenFields($code) + ['grant_type' => 'authorization_code'];
    }

    /**
     * {@inheritdoc}
     */
    protected function getUserByToken($token)
    {
        $fields = implode(',', $this->fields);

        // $url = 'https://api.linkedin.com/v1/people/~:('.$fields.')';
        $url = 'https://api.linkedin.com/v2/me/?projection=('.$fields.')';
        $response = $this->getHttpClient()->get($url, [
            'headers' => [
                'x-li-format' => 'json',
                'Authorization' => 'Bearer '.$token,
            ],
        ]);

        $url2 = 'https://api.linkedin.com/v2/emailAddress?q=members&projection=(elements*(handle~))';
        $response2 = $this->getHttpClient()->get($url2, [
            'headers' => [
                'x-li-format' => 'json',
                'Authorization' => 'Bearer '.$token,
            ],
        ]); 
        $basic_data = json_decode($response->getBody(), true);
        $email_data = json_decode($response2->getBody(), true);
            
        $linked_id = $basic_data['id'];
        $first_name = $basic_data['firstName']['localized']['en_US'];
        $last_name = $basic_data['lastName']['localized']['en_US'];
        $headshot = $basic_data['profilePicture']['displayImage~']['elements'][3]['identifiers'][0]['identifier'];
        $email = $email_data['elements'][0]['handle~']['emailAddress'];
        // print_r($email_data->elements[0]->{"handle~"}->emailAddress);
        $response_data = [
            "id"=>$linked_id,
            "first"=>$first_name,
            "last"=>$last_name,
            "email"=>$email,
            "profile_picture"=>$headshot,
        ];
        $res = json_encode($response_data);
        return json_decode($res,true);
    }

    /**
     * {@inheritdoc}
     */
    protected function mapUserToObject(array $user)
    {   
        return (new User)->setRaw($user)->map([
            'id' => $user['id'], 
            'first' => $user['first'],
            'last' => $user['last'],
            'email' => $user['email'],
            'profile_picture' => $user['profile_picture']
        ]);
    }

    /**
     * Set the user fields to request from LinkedIn.
     *
     * @param  array  $fields
     * @return $this
     */
    public function fields(array $fields)
    {
        $this->fields = $fields;

        return $this;
    }
}
