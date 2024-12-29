<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<!-- Botón para abrir el modal -->
<button type="button" id="addRoomBtn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoomModal">
  Add Room
</button>

<!-- Modal -->
<div class="modal fade" id="addRoomModal" tabindex="-1" aria-labelledby="addRoomModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addRoomModalLabel">Handle Room</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addRoomForm" method="POST" action="addRoom">
          <div class="mb-3">
            <label for="roomName" class="form-label">Room Name</label>
            <input type="text" id="roomName" name="name" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="roomDescription" class="form-label">Description</label>
            <textarea id="roomDescription" name="description" class="form-control" required></textarea>
          </div>
          <div class="mb-3">
            <label for="roomImageUrl" class="form-label">Image URL</label>
            <input type="url" id="roomImageUrl" name="image_url" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="pricePerNight" class="form-label">Price per Night</label>
            <input type="number" id="pricePerNight" name="price_per_night" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="roomStatus" class="form-label">Room Status</label>
            <select id="roomStatus" name="room_status" class="form-select" required>
              <option value="public">Public</option>
              <option value="hidden">Hidden</option>
            </select>
          </div>
          <button type="submit" class="btn btn-success w-100">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>


<script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const validation = new JustValidate('#addRoomForm', {
      errorFieldCssClass: 'is-invalid',
      errorLabelCssClass: 'text-danger',
      focusInvalidField: true,
    });

    validation
      .addField('#roomName', [{
          rule: 'required',
          errorMessage: 'Room name is required'
        },
        {
          rule: 'maxLength',
          value: 50,
          errorMessage: 'Maximum 50 characters'
        },
      ])
      .addField('#roomDescription', [{
          rule: 'required',
          errorMessage: 'Description is required'
        },
        {
          rule: 'maxLength',
          value: 300,
          errorMessage: 'Maximum 300 characters'
        },
      ])
      .addField('#roomImageUrl', [{
        rule: 'required',
        errorMessage: 'Image URL is required'
      }, ])
      .addField('#pricePerNight', [{
          rule: 'required',
          errorMessage: 'Price is required'
        },
        {
          rule: 'number',
          errorMessage: 'Must be a valid number'
        },
        {
          rule: 'minNumber',
          value: 0,
          errorMessage: 'Must be greater than 0'
        }
      ])
      .addField('#roomStatus', [{
        rule: 'required',
        errorMessage: 'Room status is required'
      }, ])
      .onSuccess((event) => {
        console.log('Form is valid');
        event.target.submit(); // Enviar formulario
      })
      .onFail(() => {
        console.log('Form validation failed');
      });
  });
</script>