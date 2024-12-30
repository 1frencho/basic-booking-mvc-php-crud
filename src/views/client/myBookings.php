<?php
$breadTitle = 'My Bookings';
$breadDesc = 'Manage bookings';
require __DIR__ . '/../../components/BreadCrumb.php';
?>
<style>
  #myBreadCrumb {
    background-image: url('assets/images/3.webp');
  }
</style>
<!-- AG Grid CSS (Material Theme) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ag-grid-community/styles/ag-theme-material.css">

<style>
  .ag-theme-material {
    height: 600px;
    /* Ajusta según sea necesario */
    width: 100%;
    /* Ancho completo */
  }
</style>

<!-- Contenedor para AG Grid -->

<section class="flex flex-col p-4 md:p-8 gap-4 w-full">

  <?php
  require __DIR__ . '/../../components/dialogs/EditBookingStatusClient.php';
  require __DIR__ . '/../../components/WarningAlert.php';
  require __DIR__ . '/../../components/SuccessAlert.php'

  ?>
  <!-- Contenedor para AG Grid -->
  <div id="bookingGrid" class="ag-theme-material"></div>
  </div>
</section>

<div id="bookingGrid" class="ag-theme-material"></div>

<!-- AG Grid JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/ag-grid-community/dist/ag-grid-community.min.js"></script>

<script>
  // Define las columnas y las opciones de la cuadrícula
  const gridOptions = {
    columnDefs: [{
        field: "booking_id",
        headerName: "Booking ID",
        sortable: true,
        filter: true
      },
      {
        field: "start_date",
        headerName: "Start Date",
        sortable: true,
        filter: true
      },
      {
        field: "end_date",
        headerName: "End Date",
        sortable: true,
        filter: true
      },
      {
        field: "user_email",
        headerName: "User Email",
        sortable: true,
        filter: true
      },
      {
        field: "user_first_name",
        headerName: "Client Name",
        sortable: true,
        filter: true
      },
      {
        field: "user_phone_number",
        headerName: "Phone Number",
        sortable: true,
        filter: true
      },
      {
        field: "room_id",
        headerName: "Room ID",
        sortable: true,
        filter: true
      },
      {
        field: "room_name",
        headerName: "Room Name",
        sortable: true,
        filter: true
      },
      {
        field: "booking_status",
        headerName: "Status",
        sortable: true,
        filter: true
      },
      {
        field: "booking_status",
        headerName: "Actions",
        sortable: true,
        filter: true,
        cellRenderer: params => params.value === 'pending' ? `
            <button class="myPrimaryBtn edit-status-btn" 
                data-id="${params.data.booking_id}" 
                data-status="${params.value}"
                data-bs-toggle="modal" 
                data-bs-target="#editStatusModal">
                Edit
            </button>` : ``
      }

    ],
    defaultColDef: {
      flex: 1, // Columnas responsivas
      minWidth: 100,
      filter: true,
      sortable: true,
      floatingFilter: true, // Filtros flotantes
    },
    pagination: true, // Activar paginación
    paginationPageSize: 10, // Tamaño de página por defecto
    paginationPageSizeSelector: [5, 10, 20, 50, 100], // Opciones de tamaño de página
    onGridReady: function(params) {
      // Cargar datos desde la API cuando la cuadrícula esté lista
      console.log("Grid is ready");
      fetch("api/myBookings")
        .then(response => response.json())
        .then(data => {
          console.log("Data loaded:", data);
          // Utiliza applyTransaction para agregar datos a la cuadrícula
          params.api.applyTransaction({
            add: data
          });
        })
        .catch(error => {
          console.error("Error trying to load data:", error);
        });
    }
  };

  // Crear e inicializar la cuadrícula
  document.addEventListener("DOMContentLoaded", function() {
    const gridDiv = document.querySelector("#bookingGrid");
    agGrid.createGrid(gridDiv, gridOptions);
  });
</script>