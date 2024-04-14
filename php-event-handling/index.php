<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Metadata and external stylesheets -->
    <meta charset="utf-8" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <!-- Heading and instruction button -->
    <h2 class="event-heading text-center mt-5">
        Event Handling in Calendar
        <!-- Instruction button -->
        <button type="button" class="btn btn-secondary" id="instructionButton">
            Instructions
        </button>
    </h2>

    <!-- Container for the calendar -->
    <div class="container">
        <div id="calendar"></div>
    </div>

    <!-- Event modal for adding new events -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal header -->
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="eventModalLabel">Add New Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal body with form -->
                <div class="modal-body">
                    <form id="eventForm">
                        <!-- Event title input -->
                        <div class="mb-3">
                            <label for="eventTitle" class="form-label">Event Title</label>
                            <input type="text" class="form-control" id="eventTitle" name="eventTitle" required>
                        </div>

                        <!-- Event description input -->
                        <div class="mb-3">
                            <label for="eventDescription" class="form-label">Event Description</label>
                            <textarea class="form-control" id="eventDescription" name="eventDescription" required rows="3"></textarea>
                        </div>

                        <!-- Start date and time input -->
                        <div class="mb-3">
                            <label for="startDate" class="form-label">Start Date and Time</label>
                            <input type="datetime-local" class="form-control" id="startDate" name="startDate" required>
                        </div>

                        <!-- End date and time input -->
                        <div class="mb-3">
                            <label for="endDate" class="form-label">End Date and Time</label>
                            <input type="datetime-local" class="form-control" id="endDate" name="endDate" required>
                        </div>

                        <!-- Submit button for form -->
                        <button type="submit" class="btn btn-success w-100">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Event details modal for viewing and managing events -->
    <div id="eventDetailsModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="eventDetailsTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal header -->
                <div class="modal-header eventdetails-modal-header">
                    <h5 id="eventDetailsTitle" class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <!-- Event description section -->
                    <div class="event-description mb-3">
                        <h6 class="text-muted">Description</h6>
                        <p id="eventDetailsDescription" class="description-textarea mt-2 ms-2"></p>
                    </div>

                    <!-- Start time section -->
                    <div class="event-time mb-2">
                        <h6 class="text-muted">Start Time</h6>
                        <p id="eventDetailsStart" class="text-success mt-2 ms-2"></p>
                    </div>

                    <!-- End time section -->
                    <div class="event-time mb-2">
                        <h6 class="text-muted">End Time</h6>
                        <p id="eventDetailsEnd" class="text-danger mt-2 ms-2"></p>
                    </div>
                </div>

                <!-- Modal footer with buttons -->
                <div class="modal-footer eventdetails-modal-footer">
                    <button type="button" class="btn btn-warning me-2" id="editEventButton">Edit</button>
                    <button type="button" class="btn btn-danger me-2" id="deleteEventButton">Delete</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit event modal for modifying events -->
    <div class="modal fade edit-event-modal" id="editEventModal" tabindex="-1" aria-labelledby="editEventModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal header -->
                <div class="modal-header text-white">
                    <h5 class="modal-title" id="editEventModalLabel">Edit Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal body with form -->
                <div class="modal-body">
                    <form id="editEventForm">
                        <!-- Hidden input for event ID -->
                        <input type="hidden" id="editEventId" name="eventId">

                        <!-- Event title input -->
                        <div class="mb-3">
                            <label for="editEventTitle" class="form-label">Event Title</label>
                            <input type="text" class="form-control" id="editEventTitle" name="eventTitle" required>
                        </div>

                        <!-- Event description input -->
                        <div class="mb-3">
                            <label for="editEventDescription" class="form-label">Event Description</label>
                            <textarea class="form-control edit-description-textarea" id="editEventDescription" name="eventDescription" required></textarea>
                        </div>

                        <!-- Start date and time input -->
                        <div class="mb-3">
                            <label for="editStartDate" class="form-label">Start Date and Time</label>
                            <input type="datetime-local" class="form-control" id="editStartDate" name="startDate" required>
                        </div>

                        <!-- End date and time input -->
                        <div class="mb-3">
                            <label for="editEndDate" class="form-label">End Date and Time</label>
                            <input type="datetime-local" class="form-control" id="editEndDate" name="endDate" required>
                        </div>

                        <!-- Modal footer with update button -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-warning">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- External scripts -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Script for handling calendar and events -->
    <script src="./script.js"></script>
</body>

</html>