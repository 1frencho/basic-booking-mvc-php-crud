<!-- 

COMPONENTE: https://tailgrids.com/components/datepicker

-->

<?php if (isset($_SESSION['user'])): ?>
  <section class="flex flex-col w-full">
    <div class="w-full">
      <div class="mb-4">
        <label for="datepicker" class="mb-[10px] block text-base font-medium text-gray-600 dark:text-white">
          Select a Date Range
        </label>
        <div class="relative">
          <!-- Datepicker Input with Icons -->
          <div class="relative flex items-center">
            <span class="absolute left-0 pl-5 text-gray-600">
              <!-- Calendar Icon -->
              <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M17.5 3.3125H15.8125V2.625C15.8125 2.25 15.5 1.90625 15.0937 1.90625C14.6875 1.90625 14.375 2.21875 14.375 2.625V3.28125H5.59375V2.625C5.59375 2.25 5.28125 1.90625 4.875 1.90625C4.46875 1.90625 4.15625 2.21875 4.15625 2.625V3.28125H2.5C1.4375 3.28125 0.53125 4.15625 0.53125 5.25V16.125C0.53125 17.1875 1.40625 18.0937 2.5 18.0937H17.5C18.5625 18.0937 19.4687 17.2187 19.4687 16.125V5.25C19.4687 4.1875 18.5625 3.3125 17.5 3.3125ZM2.5 4.71875H4.1875V5.34375C4.1875 5.71875 4.5 6.0625 4.90625 6.0625C5.3125 6.0625 5.625 5.75 5.625 5.34375V4.71875H14.4687V5.34375C14.4687 5.71875 14.7812 6.0625 15.1875 6.0625C15.5937 6.0625 15.9062 5.75 15.9062 5.34375V4.71875H17.5C17.8125 4.71875 18.0625 4.96875 18.0625 5.28125V7.34375H1.96875V5.28125C1.96875 4.9375 2.1875 4.71875 2.5 4.71875ZM17.5 16.6562H2.5C2.1875 16.6562 1.9375 16.4062 1.9375 16.0937V8.71875H18.0312V16.125C18.0625 16.4375 17.8125 16.6562 17.5 16.6562Z"
                  fill="#888" />
              </svg>
            </span>
            <input id="datepicker" type="text"
              class="w-full rounded-lg border border-stroke bg-transparent py-2.5 pl-[50px] pr-8 text-gray-600 outline-none transition focus:border-primary dark:border-dark-3 dark:text-gray-600-6 dark:focus:border-primary"
              placeholder="Select a date" readonly />
            <span class="absolute right-0 cursor-pointer pr-4 text-gray-600" id="toggleDatepicker">
              <svg class="fill-current stroke-current" width="16" height="16" viewBox="0 0 16 16" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M2.29635 5.15354L7.65055 10.3827L8.00157 10.7255L8.35095 10.381L13.701 5.10603L8.04946 10.8433L8.04635 10.8464C8.01594 10.8768 7.99586 10.8921 7.98509 10.8992C7.97746 10.8983 7.97257 10.8968 7.96852 10.8952C7.96226 10.8929 7.94944 10.887 7.92872 10.8721L2.20253 5.2455C2.18478 5.22733 2.18115 5.2112 2.18115 5.19999C2.18115 5.18859 2.18491 5.17209 2.20346 5.15354C2.222 5.13499 2.2385 5.13124 2.2499 5.13124C2.2613 5.13124 2.2778 5.13499 2.29635 5.15354Z"
                  fill="#888" />
              </svg>
            </span>
          </div>

          <!-- Datepicker Container -->
          <div id="datepicker-container"
            class="shadow-datepicker absolute mt-2 hidden rounded-xl border border-stroke bg-white pt-5 dark:border-dark-3 dark:bg-dark-2">
            <div class="flex items-center justify-between px-5">
              <button id="prevMonth"
                class="rounded-md px-2 py-2 text-gray-600 hover:bg-gray-200 dark:text-white dark:hover:bg-dark">
                &lt;
              </button>
              <div id="currentMonth" class="text-lg font-medium text-gray-600 dark:text-white"></div>
              <button id="nextMonth"
                class="rounded-md px-2 py-2 text-gray-600 hover:bg-gray-200 dark:text-white dark:hover:bg-dark">
                &gt;
              </button>
            </div>
            <div class="grid grid-cols-7 gap-1 px-5 mt-4 text-center text-sm font-medium text-gray-600">
              <div>Sun</div>
              <div>Mon</div>
              <div>Tue</div>
              <div>Wed</div>
              <div>Thu</div>
              <div>Fri</div>
              <div>Sat</div>
            </div>
            <div id="days-container" class="mt-2 grid grid-cols-7 gap-y-2 px-5"></div>

            <!-- Buttons -->
            <div class="flex justify-end space-x-2.5 border-t border-stroke p-5 dark:border-dark-3">
              <button id="cancelButton"
                class="rounded-lg border border-primary px-5 py-2.5 text-base font-medium text-primary hover:bg-blue-light-5">
                Cancel
              </button>
              <button id="applyButton"
                class="rounded-lg bg-primary px-5 py-2.5 text-base font-medium text-white hover:bg-[#1B44C8]">
                Apply
              </button>
            </div>
          </div>

          <!-- Formulario para enviar la reserva -->
          <form action="createBooking" method="POST" id="bookingForm" class="mt-4">
            <input type="hidden" name="id_room" id="roomIdField">
            <input type="hidden" name="start_date" id="startDateField">
            <input type="hidden" name="end_date" id="endDateField">
            <button type="submit" class="myPrimaryBtn">Book Now</button>
          </form>
        </div>
      </div>
    </div>
  </section>
  <script>
    const datepicker = document.getElementById("datepicker");
    const datepickerContainer = document.getElementById(
      "datepicker-container",
    );
    const daysContainer = document.getElementById("days-container");
    const currentMonthElement = document.getElementById("currentMonth");
    const prevMonthButton = document.getElementById("prevMonth");
    const nextMonthButton = document.getElementById("nextMonth");
    const cancelButton = document.getElementById("cancelButton");
    const applyButton = document.getElementById("applyButton");
    const toggleDatepicker = document.getElementById("toggleDatepicker");

    // Form values

    const roomIdField = document.getElementById('roomIdField');
    const startDateField = document.getElementById('startDateField');
    const endDateField = document.getElementById('endDateField');

    let currentDate = new Date();
    let selectedStartDate = null;
    let selectedEndDate = null;

    // Function to render the calendar
    function renderCalendar() {
      const year = currentDate.getFullYear();
      const month = currentDate.getMonth();

      currentMonthElement.textContent = currentDate.toLocaleDateString(
        "en-US", {
          month: "long",
          year: "numeric"
        },
      );

      daysContainer.innerHTML = "";
      const firstDayOfMonth = new Date(year, month, 1).getDay();
      const daysInMonth = new Date(year, month + 1, 0).getDate();

      for (let i = 0; i < firstDayOfMonth; i++) {
        daysContainer.innerHTML += `<div></div>`;
      }

      for (let i = 1; i <= daysInMonth; i++) {
        const day = new Date(year, month, i);
        const dayString = day.toLocaleDateString("en-US");

        let className =
          "flex items-center justify-center cursor-pointer w-[46px] h-[46px] rounded-full text-gray-600-3 dark:text-gray-600-6 hover:bg-primary hover:text-white";

        // Highlight start and end dates
        if (selectedStartDate && dayString === selectedStartDate) {
          className +=
            " bg-cyan-600 text-white dark:text-white rounded-r-none";
        }
        if (selectedEndDate && dayString === selectedEndDate) {
          className +=
            " bg-cyan-600 text-white dark:text-white rounded-l-none";
        }

        // Highlight dates between start and end
        if (
          selectedStartDate &&
          selectedEndDate &&
          new Date(day) > new Date(selectedStartDate) &&
          new Date(day) < new Date(selectedEndDate)
        ) {
          className += " bg-gray-300 text-white rounded-none"; // Add your custom class for the range
        }

        daysContainer.innerHTML += `<div class="${className}" data-date="${dayString}">${i}</div>`;
      }

      document.querySelectorAll("#days-container div").forEach((day) => {
        day.addEventListener("click", function(event) {
          event.stopPropagation(); // Prevent event from bubbling up to document

          const selectedDay = this.dataset.date;

          if (!selectedStartDate || (selectedStartDate && selectedEndDate)) {
            selectedStartDate = selectedDay;
            selectedEndDate = null;
          } else {
            if (new Date(selectedDay) < new Date(selectedStartDate)) {
              selectedEndDate = selectedStartDate;
              selectedStartDate = selectedDay;
            } else {
              selectedEndDate = selectedDay;
            }
          }

          updateInput();
          renderCalendar(); // Re-render calendar to update highlighted range
        });
      });
    }

    // Function to update the datepicker input
    function updateInput() {
      if (selectedStartDate && selectedEndDate) {
        datepicker.value = `${selectedStartDate} - ${selectedEndDate}`;
        // Form values
        startDateField.value = new Date(selectedStartDate).toISOString().split("T")[0];
        endDateField.value = new Date(selectedEndDate).toISOString().split("T")[0];

        console.log({
          startDateField: startDateField.value,
          endDateField: endDateField.value,
          roomIdField: roomIdField.value,
        });
      } else if (selectedStartDate) {
        datepicker.value = selectedStartDate;
      } else {
        datepicker.value = "";
      }
    }

    // Toggle datepicker visibility
    datepicker?.addEventListener("click", function(event) {
      event.stopPropagation(); // Prevent click from bubbling up to document
      datepickerContainer?.classList.toggle("hidden");
      renderCalendar();
    });

    toggleDatepicker?.addEventListener("click", function(event) {
      event.stopPropagation(); // Prevent click from bubbling up to document
      datepickerContainer?.classList.toggle("hidden");
      renderCalendar();
    });

    // Navigate months
    prevMonthButton?.addEventListener("click", function() {
      currentDate.setMonth(currentDate.getMonth() - 1);
      renderCalendar();
    });

    nextMonthButton?.addEventListener("click", function() {
      currentDate.setMonth(currentDate.getMonth() + 1);
      renderCalendar();
    });

    // Cancel selection and close calendar
    cancelButton?.addEventListener("click", function() {
      selectedStartDate = null;
      selectedEndDate = null;
      updateInput();
      datepickerContainer?.classList.add("hidden");
    });

    // Apply selection and close calendar
    applyButton?.addEventListener("click", function() {
      updateInput();
      datepickerContainer?.classList.add("hidden");
    });

    // Close calendar when clicking outside of it
    document?.addEventListener("click", function(event) {
      if (
        !datepicker?.contains(event.target) &&
        !datepickerContainer?.contains(event.target)
      ) {
        datepickerContainer?.classList.add("hidden");
      }
    });
  </script>
<?php else: ?>
  <a href="signIn" class="myPrimaryBtn">Sign In to book a room</a>
<?php endif; ?>