<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="new_modal_header">
        <button type="button" class="btn-close new_modal_close_btn" data-dismiss="modal" aria-label="Close">
          <img alt="" src="{{asset('new-theme/images/icon_close.png')}}"></button>
        <h2 class="new_modal_header_title">Edit Hackathon</h2>
      </div>
      <hr />
    </div>
  </div>
</div>
<form id="hackathon_add_form" class="form_class add_hackathon_form" enctype="multipart/form-data">
  @csrf
  <input type="hidden" id="ha_pic" >
  <div class="form-group">
    <input type="text" placeholder="Hackathon's name*" value="{{ $experience->name }}" class="form-control hackathon_input" id="ha_name">
  </div>
  <div class="form-group ha_organized">
    <input type="text" class="form-control hackathon_input" value="{{ $experience->organized_by }}" placeholder="Hosted/Organized by*" id="ha_organized">
  </div>
  <div class="form-row">
    <div class="form-group col-md-4 ha_from">
      <input type="text" placeholder="From*" value="<?php echo date('d-m-Y',strtotime($experience->from)); ?>" class="form-control datepicker hackathon_input " id="ha_from">
    </div>
    <div class="form-group col-md-4">
      <input type="text" placeholder="To*" value="<?php echo date('d-m-Y',strtotime($experience->to)); ?>" class="form-control datepicker hackathon_input" id="ha_to">
    </div>
    <div class="form-group col-md-4 place_msg">
      <select class="form-control hackathon_input" id="ha_result">
        <option value="" selected>Select Result*</option>
        @foreach($badges as $badge)
          <option value="<?php echo $badge->id ?>" <?php if($badge->id==$experience->badge_id){ echo "selected"; } ?> >{{$badge->name}}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="ha_description" class="hackathon_input_label">Description (HTML editor)*</label>
    <textarea class="form-control hackathon_input_textarea" rows="5" id="ha_description"><?php echo str_replace("\\","",nl2br($experience->description)) ?></textarea>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label class="hackathon_input_label">Upload Hackathon's logo/IMG</label>
      <div class="custom-file">
        <input type="file" name="file" class="custom-file-input hackathon_input" id="new_hackathon_img">
        <label class="custom-file-label add_hackathon_file_label" for="hackathon_img"></label>
      </div>

    </div>
    <div class="form-group col-sm-2 ha_pic_msg">
      <img style="width:100px;" src="{{ Storage::url($experience->pic) }}">
    </div>

  </div>
  <div class="form-group text-right ha_success">
  </div>
  <div class="form-group text-right">
    <button type="button" id="ha_submit" class="btn add_hackathon_submit_btn">SAVE</button>
  </div>
</form>