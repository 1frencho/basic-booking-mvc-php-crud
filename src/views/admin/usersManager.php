<?php
$breadTitle = 'User Manager';
$breadDesc = 'Manage users';
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
    /* Ajusta según sea necesario */
    width: 100%;
    /* Ancho completo */
  }
</style>

<!-- Contenedor para AG Grid -->
<div id="userGrid" class="ag-theme-material"></div>

<!-- AG Grid JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/ag-grid-community/dist/ag-grid-community.min.js"></script>

<script>
  // Define las columnas y las opciones de la cuadrícula
  const gridOptions = {
    columnDefs: [{
        field: "id",
        headerName: "User ID",
        sortable: true,
        filter: true
      },
      {
        field: "email",
        headerName: "Email",
        sortable: true,
        filter: true
      },
      {
        field: "role",
        headerName: "Role",
        sortable: true,
        filter: true
      },
      {
        field: "first_name",
        headerName: "First Name",
        sortable: true,
        filter: true
      },
      {
        field: "last_name",
        headerName: "Last Name",
        sortable: true,
        filter: true
      },
      {
        field: "phone_number",
        headerName: "Phone Number",
        sortable: true,
        filter: true
      },
      {
        field: "created_at",
        headerName: "Created At",
        sortable: true,
        filter: true
      },
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
    onGridReady: function(params) {
      // Cargar datos desde la API cuando la cuadrícula esté lista
      console.log("Grid is ready");
      fetch("api/users")
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
    const gridDiv = document.querySelector("#userGrid");
    agGrid.createGrid(gridDiv, gridOptions);
  });
</script>