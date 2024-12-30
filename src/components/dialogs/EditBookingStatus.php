<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


<!-- Modal para Editar Estado -->
<div class="modal fade" id="editStatusModal" tabindex="-1" aria-labelledby="editStatusModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editStatusModalLabel">Edit Booking Status</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" action="updateBookingStatusAdmin">
        <div class="modal-body">
          <input type="hidden" name="booking_id" id="editBookingId">
          <div class="mb-3">
            <label for="editStatus" class="form-label">Status</label>
            <select id="editStatus" name="status" class="form-select" required>
              <option value="pending">Pending</option>
              <option value="approved">Approved</option>
              <option value="cancelled">Cancelled</option>
              <option value="ended">Ended</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="myPrimaryBtn">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const editBookingId = document.getElementById('editBookingId');
    const editStatus = document.getElementById('editStatus');

    document.addEventListener('click', (event) => {
      if (event.target.classList.contains('edit-status-btn')) {
        const bookingId = event.target.dataset.id;
        const currentStatus = event.target.dataset.status;

        // Cargar datos en el modal
        editBookingId.value = bookingId;
        editStatus.value = currentStatus;
      }
    });
  });
</script>