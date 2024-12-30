<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


<!-- Modal para Editar Estado -->
<div class="modal fade" id="editStatusModal" tabindex="-1" aria-labelledby="editStatusModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editStatusModalLabel">Edit Booking Status</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" action="updateBookingStatusClient">
        <div class="modal-body">
          <input type="hidden" name="booking_id" id="editBookingId">
          <div class="mb-3">
            <label for="editStatus" class="form-label">Status</label>
            <select id="editStatus" name="status" class="form-select" required>
              <option value="pending">Pending</option>
              <option value="cancelled">Cancelled</option>
            </select>
          </div>
          <button type="submit" class="myPrimaryBtn">Save Changes</button>
        </div>
      </form>
      <div class="modal-footer">

        <form action="removeBookingClient" method="POST">
          <input type="hidden" name="booking_id" id="removeBookingId">
          <button type="submit" class="btn btn-danger">Remove Booking</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const editBookingId = document.getElementById('editBookingId');
    const editStatus = document.getElementById('editStatus');
    const removeBookingId = document.getElementById('removeBookingId');

    document.addEventListener('click', (event) => {
      if (event.target.classList.contains('edit-status-btn')) {
        const bookingId = event.target.dataset.id;
        const currentStatus = event.target.dataset.status;

        // Cargar datos en el modal
        editBookingId.value = bookingId;
        editStatus.value = currentStatus;
        removeBookingId.value = bookingId;
      }
    });
  });
</script>