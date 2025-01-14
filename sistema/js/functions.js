$(document).ready(function () {
  //  Actualizar datos de la empresa
  $("#formEmpresa").submit(function (e) {
    /* e.preventDefault(); */
    var intNit = $("#txtRuc").val();
    var intDv = $("#txtDv").val();
    var strNombreEmp = $("#txtNombre").val();
    var strRSocialEmp = $("#txtRSocial").val();
    var intTelEmp = $("#txtTelEmpresa").val();
    var strEmailEmp = $("#txtEmailEmpresa").val();
    var strDirEmp = $("#txtDirEmpresa").val();

    if (
      intNit == "" ||
      intDv == "" ||
      strNombreEmp == "" ||
      intTelEmp == "" ||
      strEmailEmp == "" ||
      strDirEmp == ""
    ) {
      $(".alertFormEmpresa").html(
        '<p style="color: red;">Todos los campos son obligatorios.</p>'
      );
      $(".alertFormEmpresa").slideDown();
      return false;
    }

    $.ajax({
      url: "ajax.php",
      type: "POST",
      async: true,
      data: $("#formEmpresa").serialize(),
      beforeSend: function () {
        $(".alertFormEmrpresa").slideUp();
        $(".alertFormEmrpresa").html("");
        $("#formEmpresa input").attr('disabled", disabled');
      },
      success: function (response) {
        var info = JSON.parse(response);
        if (info.cod == "00") {
          $(".alertChangePass").html(
            '<p style="color: green;">' + info.msg + "</p>"
          );
          $(".alertFormEmpresa").slideDown();
        } else {
          $(".alertFormEmpresa").html(
            '<p style="color: red;">' + info.msg + "</p>"
          );
        }
        $(".alertFormEmpresa").slideDown();
        $("#formEmpresa input").removeAttr("disabled");
      },
      error: function (error) {},
    });
  });
});
  // Función para mostrar el modal y detalles del cliente
document.addEventListener("DOMContentLoaded", function () {
  const modal = document.getElementById("clientModal");
  const closeBtn = document.querySelector(".modal-close");

  window.showClientDetails = function (client) {
    document.getElementById("modal-carpeta").textContent = client.n_carpeta;
    document.getElementById("modal-cliente-desde").textContent = formatDate(
      client.cliente_desde
    );
    document.getElementById("modal-ruc").textContent = client.ruc;
    document.getElementById("modal-dv").textContent = client.dv;
    document.getElementById("modal-nombre").textContent = client.nombre;
    document.getElementById("modal-fantasia").textContent =
      client.nombre_fantasia;
    document.getElementById("modal-telefono").textContent = client.telefono;
    document.getElementById("modal-direccion").textContent = client.direccion;
    document.getElementById("modal-vencimiento").textContent = formatDate(
      client.vencimiento
    );

// Funcion para Cargar las obligaciones del cliente
fetch(`get_obligaciones.php?id_cliente=${client.id}`)
  .then((response) => response.json())
  .then((data) => {
    const obligacionesContainer = document.getElementById("modal-obligaciones");
    obligacionesContainer.innerHTML = ""; 

    if (data.success) {
      if (data.obligaciones.length === 0) {
        obligacionesContainer.innerHTML =
          "<p>No hay obligaciones registradas para este cliente.</p>";
        return;
      }

        const tableContainer = document.createElement("div");
        tableContainer.className = "obligaciones-container";

        const table = document.createElement("table");
        table.className = "obligaciones-table";

        const thead = document.createElement("thead");
        thead.innerHTML = `
        <tr>
            <th>Obligaciones</th>
        </tr>
        `;
        table.appendChild(thead);

        const tbody = document.createElement("tbody");
        data.obligaciones.forEach((obligacion) => {
        const tr = document.createElement("tr");
        tr.innerHTML = `
            <td>${obligacion.n_oblig}</td>
        `;
        tbody.appendChild(tr);
        });
        table.appendChild(tbody);

        tableContainer.appendChild(table);

        obligacionesContainer.appendChild(tableContainer);

    } else {
      console.error("Error al cargar las obligaciones:", data.error);
      obligacionesContainer.innerHTML =
        "<p>Error al cargar las obligaciones del cliente.</p>";
    }
  })
  .catch((error) => {
    console.error("Error en la petición:", error);
    document.getElementById("modal-obligaciones").innerHTML =
      "<p>Error al cargar las obligaciones del cliente.</p>";
  });

    modal.style.display = "block";
  };

  function formatDate(dateString) {
    if (!dateString) return "";
    const date = new Date(dateString);
    return date.toLocaleDateString("es-PY");
  }

  closeBtn.addEventListener("click", closeModal);

  window.addEventListener("click", function (event) {
    if (event.target === modal) {
      closeModal();
    }
  });

  document.addEventListener("keydown", function (event) {
    if (event.key === "Escape" && modal.style.display === "block") {
      closeModal();
    }
  });
});

// Función para mostrar el modal de edición de Obligaciones
function showEditModalOblig(obligaciones) {
  document.getElementById("edit-id").value = obligaciones.id;
  document.getElementById("edit-nombre").value = obligaciones.n_oblig;
  document.getElementById("edit-monto").value = obligaciones.monto;


  document.getElementById("editModal").style.display = "block";
}

function closeEditModal() {
  document.getElementById("editModal").style.display = "none";
}

function closeModal() {
  document.getElementById("clientModal").style.display = "none";
}

// Cerrar modal al hacer clic fuera
window.onclick = function (event) {
  const modal = document.getElementById("editModal");
  if (event.target == modal) {
    closeEditModal();
  }
};

// Función para mostrar el modal de edición de cliente
function showEditModal(client) {
  document.getElementById("edit-id").value = client.id;
  document.getElementById("edit-carpeta").value = client.n_carpeta;
  document.getElementById("edit-cliente-desde").value = client.cliente_desde;
  document.getElementById("edit-ruc").value = client.ruc;
  document.getElementById("edit-dv").value = client.dv;
  document.getElementById("edit-nombre").value = client.nombre;
  document.getElementById("edit-fantasia").value = client.nombre_fantasia;
  document.getElementById("edit-telefono").value = client.telefono;
  document.getElementById("edit-direccion").value = client.direccion;
  document.getElementById("edit-vencimiento").value = client.vencimiento;

  document.getElementById("editModal").style.display = "block";
}

function closeEditModal() {
  document.getElementById("editModal").style.display = "none";
}

function closeModal() {
  document.getElementById("clientModal").style.display = "none";
}

// Cerrar modal al hacer clic fuera
window.onclick = function (event) {
  const modal = document.getElementById("editModal");
  if (event.target == modal) {
    closeEditModal();
  }
};

