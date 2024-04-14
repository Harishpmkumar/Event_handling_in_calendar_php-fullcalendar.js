$(document).ready(function () {
  // Initialize the tooltip for the instruction button
  $("#instructionButton").tooltip({
    title:
      "1. Click the date to add an event.<br>2. Click the event to view, edit, and delete.",
    placement: "bottom",
    trigger: "hover",
    html: true,
    customClass: "instructionButton-tooltip", // Custom class for tooltip styling
  });

  // Get the calendar element and initialize the FullCalendar
  var calendarEl = $("#calendar");
  var calendar = new FullCalendar.Calendar(calendarEl[0], {
    initialView: "dayGridMonth", // Initial view set to month grid
    events: "events.php", // Load events from the events.php script
    eventDisplay: "block", // Display events as block
    // Customize the event display content
    eventContent: function (arg) {
      return {
        html: `<div class="fc-event-title">${arg.event.title}</div>`,
      };
    },
    // Add tooltip to events
    eventDidMount: function (info) {
      $(info.el).tooltip({
        title: "Click the event to know more",
        placement: "bottom",
        trigger: "hover",
        html: true,
      });
    },
  });

  // Render the calendar
  calendar.render();

  // Event handler for date click
  calendar.on("dateClick", function (info) {
    // Show the event modal
    $("#eventModal").modal("show");

    // Get the current date and time
    var currentDate = new Date();
    var hours = String(currentDate.getHours()).padStart(2, "0");
    var minutes = String(currentDate.getMinutes()).padStart(2, "0");

    // Set the start date and end date
    var startDate = info.dateStr + "T" + hours + ":" + minutes;
    $("#startDate").val(startDate);
    $("#endDate").val(info.dateStr + "T23:59");
  });

  // Event handler for submitting the event form
  $("#eventForm").on("submit", function (event) {
    event.preventDefault(); // Prevent default form submission

    // Collect form data
    var formData = {
      title: $("#eventTitle").val(),
      description: $("#eventDescription").val(),
      start: $("#startDate").val(),
      end: $("#endDate").val(),
    };

    // Make AJAX POST request to add_event.php
    $.ajax({
      url: "add_event.php",
      type: "POST",
      data: formData,
      dataType: "json",
      success: function (response) {
        if (response.success) {
          // Reset the form and hide the modal
          $("#eventForm")[0].reset();
          $("#eventModal").modal("hide");
          // Refetch events to update the calendar
          calendar.refetchEvents();
        } else {
          console.error("Error adding event:", response.error);
        }
      },
      error: function (xhr, status, error) {
        console.error("AJAX request error:", error);
      },
    });
  });

  // Event handler for clicking an event
  calendar.on("eventClick", function (info) {
    var event = info.event;

    // Show the event details modal
    $("#eventDetailsModal").modal("show");

    // Populate the event details modal
    $("#eventDetailsTitle").text(event.title);
    $("#eventDetailsDescription").text(event.extendedProps.description || "");
    var options = {
      day: "numeric",
      month: "short",
      year: "numeric",
      hour: "numeric",
      minute: "numeric",
      hour12: true,
    };

    // Format the date and time
    function formatDateTime(date) {
      var formatter = new Intl.DateTimeFormat("en-GB", options);
      var formattedDate = formatter.format(date);
      // Convert "am" or "pm" to uppercase
      return formattedDate.replace(/am|pm/i, function (match) {
        return match.toUpperCase();
      });
    }

    // Populate the start and end dates in the event details modal
    $("#eventDetailsStart").text(formatDateTime(event.start));
    $("#eventDetailsEnd").text(event.end ? formatDateTime(event.end) : "");

    // Event handler for clicking the edit button
    $("#editEventButton")
      .off() // Unbind any previous event handler
      .on("click", function () {
        // Populate the edit event modal with event data
        $("#editEventId").val(event.id);
        $("#editEventTitle").val(event.title);
        $("#editEventDescription").val(event.extendedProps.description || "");
        $("#editStartDate").val(event.start.toISOString().substring(0, 16));
        $("#editEndDate").val(
          event.end ? event.end.toISOString().substring(0, 16) : ""
        );

        // Show the edit event modal and hide the event details modal
        $("#editEventModal").modal("show");
        $("#eventDetailsModal").modal("hide");
      });

    // Event handler for clicking the delete button
    $("#deleteEventButton")
      .off() // Unbind any previous event handler
      .on("click", function () {
        // Confirm the deletion of the event
        if (confirm("Are you sure you want to delete this event?")) {
          // Make AJAX POST request to delete_event.php
          $.ajax({
            url: "delete_event.php",
            method: "POST",
            data: {
              eventId: event.id,
            },
            dataType: "json",
            success: function (response) {
              if (response.success) {
                // Refetch events to update the calendar and hide the event details modal
                calendar.refetchEvents();
                $("#eventDetailsModal").modal("hide");
              } else {
                console.error("Error deleting event:", response.error);
              }
            },
            error: function (xhr, status, error) {
              console.error("AJAX request error:", error);
            },
          });
        }
      });
  });

  // Event handler for submitting the edit event form
  $("#editEventForm").on("submit", function (event) {
    event.preventDefault();

    // Collect form data
    var formData = {
      eventId: $("#editEventId").val(),
      title: $("#editEventTitle").val(),
      description: $("#editEventDescription").val(),
      start: $("#editStartDate").val(),
      end: $("#editEndDate").val(),
    };

    // Make AJAX POST request to update_event.php
    $.ajax({
      url: "update_event.php",
      method: "POST",
      data: formData,
      dataType: "json",
      success: function (response) {
        if (response.success) {
          // Refetch events to update the calendar and hide the edit event modal
          calendar.refetchEvents();
          $("#editEventModal").modal("hide");
        } else {
          console.error("Error updating event:", response.error);
        }
      },
      error: function (xhr, status, error) {
        console.error("AJAX request error:", error);
      },
    });
  });
});
