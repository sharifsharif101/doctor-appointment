@if(count($bookings)>0)
<!-- Modal -->
<div class="modal fade" id="exampleModal{{$booking->user_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="{{route('prescription')}}" method="post">
      @csrf
    
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Prescription</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="app">

        <input type="hidden" name="user_id" value="{{$booking->user_id}}">
        <input type="hidden" name="doctor_id" value="{{$booking->doctor_id}}">
        <input type="hidden" name="date" value="{{$booking->date}}">



       <div class="form-group">
        <label>Disease</label>
        <input type="text" name="name_of_disease" class="form-control" required="">
    </div>
      <div class="form-group">
        <label>Symptoms</label>
     
        <textarea name="symptoms" class="form-control" placeholder="symptoms" required=""></textarea>
    </div>

  
      <div id="medicine-list" class="form-group">
        <label>Medicine</label>
        <div class="input-group mb-2">
          <input type="text" name="medicine[]" class="form-control">
          <div class="input-group-append">
            <button class="btn btn-success add-more" type="button">Add More</button>
            <button class="btn btn-danger remove" type="button">Remove</button>
          </div>
        </div>
      </div>
 
{{-- /////////هذا الكود يقوم بإضافة  ميديسن دايناميك///////////////////// --}}

<script>
  $(document).ready(function() {
    // Function to add more medicine fields
    $(document).on('click', '.add-more', function() {
      var html = '<div class="input-group mb-2">' +
                 '<input type="text" name="medicine[]" class="form-control">' +
                 '<div class="input-group-append">' +
                 '<button class="btn btn-success add-more" type="button">Add More</button>' +
                 '<button class="btn btn-danger remove" type="button">Remove</button>' +
                 '</div>' +
                 '</div>';
      $('#medicine-list').append(html);
    });

    // Function to remove medicine fields
    $(document).on('click', '.remove', function() {
      if ($('#medicine-list .input-group').length > 1) {
        $(this).closest('.input-group').remove();
      } else {
        alert('At least one medicine field must be present.');
      }
    });
  });
</script>
{{-- ////////////////////////////// --}}




      <div class="form-group">
        <label>Procedure to use medicine</label>
          <textarea name="procedure_to_use_medicine" class="form-control" placeholder="Procedure to use medicine" required=""></textarea>
    </div>
      <div class="form-group">
        <label>Feedback</label>
        <textarea name="feedback" class="form-control" placeholder="feedback" required=""></textarea>
    </div>
    <div class="form-group">
        <label>Signature</label>
        <input type="text" name="signature" class="form-control" required="">
    </div>





      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </form>
  </div>
</div>
@endif