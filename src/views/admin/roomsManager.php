<?php
$breadTitle = 'Room Manager';
$breadDesc = 'Manage rooms';
require __DIR__ . '/../../components/BreadCrumb.php';
?>

<style>
  #myBreadCrumb {
    background-image: url('assets/images/2.webp');
  }
</style>

<!-- AG Grid CSS (Material Theme) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ag-grid-community/styles/ag-theme-material.css">

<style>
  .ag-theme-material {
    height: 600px;
    width: 100%;
  }
</style>

<section class="flex flex-col p-4 md:p-8 gap-4 w-full">
  <?php
  require __DIR__ . '/dialogs/AddRoom.php';
  require __DIR__ . '/../../components/WarningAlert.php';
  require __DIR__ . '/../../components/SuccessAlert.php';

  ?>
  <!-- Contenedor para AG Grid -->
  <div id="roomGrid" class="ag-theme-material"></div>
</section>

<!-- AG Grid JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/ag-grid-community/dist/ag-grid-community.min.js"></script>

<script>
  // Configuración de AG Grid
  const gridOptions = {
    columnDefs: [{
        field: "id",
        headerName: "Room ID",
        sortable: true,
        filter: true
      },
      {
        field: "name",
        headerName: "Name",
        sortable: true,
        filter: true
      },
      {
        field: "description",
        headerName: "Description",
        sortable: true,
        filter: true
      },
      {
        field: "image_url",
        headerName: "Image",
        cellRenderer: params => `<img src="${params.value}" alt="Room Image" style="width:50px;height:50px;">`
      },
      {
        field: "price_per_night",
        headerName: "Price per night",
        cellRenderer: params => `$${params.value}`,
        sortable: true,
        filter: true
      },
      {
        field: "room_status",
        headerName: "Status",
        sortable: true,
        filter: true
      },
      {
        headerName: "Actions",
        cellRenderer: function(params) {
          return `
            <button 
              class="myPrimaryBtn edit-btn" 
              data-id="${params.data.id}" 
              data-name="${params.data.name}" 
              data-description="${params.data.description}" 
              data-image_url="${params.data.image_url}" 
              data-price_per_night="${params.data.price_per_night}" 
              data-room_status="${params.data.room_status}">
              Edit
            </button>`;
        },
        sortable: false,
        filter: false,
        width: 150
      }
    ],
    defaultColDef: {
      flex: 1,
      minWidth: 100,
      filter: true,
      sortable: true,
      floatingFilter: true
    },
    pagination: true,
    paginationPageSize: 10,
    onGridReady: function(params) {
      fetch("api/rooms")
        .then(response => response.json())
        .then(data => {
          params.api.applyTransaction({
            add: data
          });
        })
        .catch(error => console.error("Error loading data:", error));
    }
  };

  document.addEventListener("DOMContentLoaded", function() {
    const gridDiv = document.querySelector("#roomGrid");
    agGrid.createGrid(gridDiv, gridOptions);
  });

  // Lógica de edición
  document.addEventListener('click', (e) => {
    if (e.target.classList.contains('edit-btn')) {
      const id = e.target.getAttribute('data-id');
      const name = e.target.getAttribute('data-name');
      const description = e.target.getAttribute('data-description');
      const imageUrl = e.target.getAttribute('data-image_url');
      const pricePerNight = e.target.getAttribute('data-price_per_night');
      const roomStatus = e.target.getAttribute('data-room_status');

      const form = document.getElementById('addRoomForm');
      form.setAttribute('data-id', id);

      document.getElementById('roomName').value = name;
      document.getElementById('roomDescription').value = description;
      document.getElementById('roomImageUrl').value = imageUrl;
      document.getElementById('pricePerNight').value = pricePerNight;
      document.getElementById('roomStatus').value = roomStatus;

      document.getElementById('addRoomModalLabel').textContent = `Edit Room (ID: ${id})`;

      const modal = new bootstrap.Modal(document.getElementById('addRoomModal'));
      modal.show();
    }
  });
</script>