<!-- Modal para detalles -->
<div class="modal fade" id="roomDetailModal" tabindex="-1" aria-labelledby="roomDetailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="roomDetailModalLabel">Room Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="flex flex-col gap-4 md:flex-row w-full">
          <div class="w-full md:w-1/2 h-full">
            <img id="detailImg" src="" alt="Room Image"
              class="h-full min-h-[300px] w-full rounded-xl shadow-md object-cover" style="height: 100%;">
          </div>
          <div class="w-full md:w-1/2">
            <h3 id="detailName" class="text-lg font-bold text-gray-800 dark:text-white"></h3>
            <p id="detailDescription" class="mt-2 text-gray-500 dark:text-neutral-400"></p>
            <p class="mt-4 text-lg font-medium text-sky-500 dark:text-neutral-500">
              Price: $<span id="detailPrice"></span> / night
            </p>
            <p class="mt-2 text-base text-gray-600 dark:text-neutral-400">
              Status: <span id="detailStatus"></span>
            </p>
            <?php require __DIR__ . '/../BookingCalendar.php'; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const modal = new bootstrap.Modal(document.getElementById('roomDetailModal'));
    const detailName = document.getElementById('detailName');
    const detailDescription = document.getElementById('detailDescription');
    const detailImg = document.getElementById('detailImg');
    const detailPrice = document.getElementById('detailPrice');
    const detailStatus = document.getElementById('detailStatus');
    const roomIdField = document.getElementById('roomIdField');

    // Evento para mostrar detalles en el modal
    document.querySelectorAll('.room-detail-btn').forEach(button => {
      button?.addEventListener('click', () => {
        const name = button.getAttribute('data-name');
        const description = button.getAttribute('data-description');
        const imageUrl = button.getAttribute('data-image-url');
        const price = button.getAttribute('data-price');
        const status = button.getAttribute('data-status');
        const roomId = button.getAttribute('data-room-id'); // ID de la habitación

        // Actualizar el campo oculto id_room en el formulario del calendario
        if (roomIdField) {
          roomIdField.value = roomId;
        }

        // Actualizar los detalles en el modal
        detailName.textContent = name;
        detailDescription.textContent = description;
        detailImg.src = imageUrl;
        detailPrice.textContent = price;
        detailStatus.textContent = status;

        // Mostrar el modal
        modal.show();
      });
    });

  });
</script>