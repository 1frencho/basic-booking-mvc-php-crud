<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Botón para abrir el modal -->
<button type="button" id="addRoomBtn" class="myPrimaryBtn" data-bs-toggle="modal" data-bs-target="#addRoomModal">
  Add Room
</button>

<!-- Modal -->
<div class="modal fade" id="addRoomModal" tabindex="-1" aria-labelledby="addRoomModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addRoomModalLabel">Handle Room</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body flex md:flex-row h-full flex-col gap-4">
        <div class="w-full md:w-1/2 min-h-full flex flex-col gap-4">
          <img src="assets/images/sky.webp" alt="Room Image" class="w-full rounded-xl h-full object-cover"
            id="roomImage" style="height: 100%;">
        </div>
        <div class="w-full md:w-1/2 h-full flex flex-col ">
          <form id="addRoomForm" method="POST" action="addRoom">
            <input type="hidden" id="roomId" name="id"> <!-- Campo oculto para el ID -->
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
            <button type="submit" class="myPrimaryBtn ">Save</button>
          </form>
          <form class="hidden mt-3" action="removeRoom" method="POST" id="removeRoomForm">
            <input type="hidden" name="room_id" id="removeRoomId">
            <button type="submit" class="btn btn-danger">Remove Room</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- JustValidate -->
<script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('addRoomForm');
    const modal = document.getElementById('addRoomModal');
    const modalLabel = document.getElementById('addRoomModalLabel');
    const roomIdField = document.getElementById('roomId');
    const removeRoomIdField = document.getElementById('removeRoomId');

    // Configuración de JustValidate
    const validation = new JustValidate('#addRoomForm', {
      errorFieldCssClass: 'is-invalid',
      errorLabelCssClass: 'text-danger',
      focusInvalidField: true,
    });

    validation
      .addField('#roomName', [{
          rule: 'required',
          errorMessage: 'Room name is required',
        },
        {
          rule: 'maxLength',
          value: 50,
          errorMessage: 'Room name cannot exceed 50 characters',
        },
      ])
      .addField('#roomDescription', [{
          rule: 'required',
          errorMessage: 'Description is required',
        },
        {
          rule: 'maxLength',
          value: 300,
          errorMessage: 'Description cannot exceed 300 characters',
        },
      ])
      .addField('#roomImageUrl', [{
        rule: 'required',
        errorMessage: 'Image URL is required',
      }, ])
      .addField('#pricePerNight', [{
          rule: 'required',
          errorMessage: 'Price per night is required',
        },
        {
          rule: 'number',
          errorMessage: 'Price must be a valid number',
        },
        {
          rule: 'minNumber',
          value: 1,
          errorMessage: 'Price must be greater than 0',
        },
      ])
      .addField('#roomStatus', [{
        rule: 'required',
        errorMessage: 'Room status is required',
      }, ])
      .onSuccess((event) => {
        console.log('Form is valid!');
        form.submit(); // Opción de enviar el formulario después de la validación
      });

    // Detectar clic en el botón "Add Room" (modo crear)
    document.getElementById('addRoomBtn').addEventListener('click', () => {
      modalLabel.textContent = 'Add Room';
      form.setAttribute('action', 'addRoom'); // Cambiar el action al endpoint de creación
      roomIdField.value = ''; // Asegurar que el ID esté vacío
      form.reset(); // Limpiar el formulario
      document.getElementById('removeRoomForm').classList.add('hidden'); // Ocultar el botón de eliminación
    });

    // Detectar clic en botones de edición
    document.addEventListener('click', (e) => {
      if (e.target.classList.contains('edit-btn')) {
        const id = e.target.getAttribute('data-id');
        const name = e.target.getAttribute('data-name');
        const description = e.target.getAttribute('data-description');
        const imageUrl = e.target.getAttribute('data-image_url');
        const pricePerNight = e.target.getAttribute('data-price_per_night');
        const roomStatus = e.target.getAttribute('data-room_status');
        const removeForm = document.getElementById('removeRoomForm');

        // Rellenar los campos del formulario
        roomIdField.value = id;
        document.getElementById('roomName').value = name;
        document.getElementById('roomDescription').value = description;
        document.getElementById('roomImageUrl').value = imageUrl;
        document.getElementById('pricePerNight').value = pricePerNight;
        document.getElementById('roomStatus').value = roomStatus;
        document.getElementById('roomImage').src = imageUrl;
        removeRoomIdField.value = id;

        // Cambiar el título y el action al endpoint de actualización
        modalLabel.textContent = `Edit Room (ID: ${id})`;
        form.setAttribute('action', `updateRoom`);

        // Mostrar el botón de eliminación
        document.getElementById('removeRoomForm').classList.remove('hidden');
      }
    });

    // Limpiar el formulario y restaurar el estado al cerrar el modal
    modal.addEventListener('hidden.bs.modal', () => {
      form.reset(); // Limpia los campos del formulario
      form.setAttribute('action', 'addRoom'); // Restablecer el action al endpoint de creación
      modalLabel.textContent = 'Handle Room'; // Restablecer el título del modal
      roomIdField.value = ''; // Asegurar que el ID esté vacío
      document.getElementById('roomImage').src = 'assets/images/sky.webp';
    });
  });
</script>