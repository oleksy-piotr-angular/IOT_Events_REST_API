#IOT_Events_REST_API

Processing information about events from IoT devices.

The system accepts information about individual events using the REST interface.

For each event entering the system, there is a need to
• validate the syntax of a specific event, assuming that all fields in each
event type are required.
• take various additional actions depending on the type of event.
Possible actions to be invoked in the system:
o log the event (send to the log),
o send an SMS or email,
o send a REST request to an external system.
Respectively for:
• deviceMalfunction: log in and send an email and SMS
• temperatureExceeded: log in and send a REST request
• doorUnlocked: log in and send an SMS.
A solution should be designed and implemented in the Symfony framework that
will handle the above requirements.
As part of handling individual additional actions, there is no need to implement
the appropriate logic (handling writing to the log, sending an SMS, etc.), it is 
enough to implement the print action logic from the system in a given place.

---

The system was tested manually in the POSTMAN application by sending the POST method 
with a body containing JSON for each Event type.
The test data from JSON was taken from task 2.
In my case, events are sent to the address:

"http://127.0.0.1:8000/api/event"

If the correct data type was used in the query, a note is received in response 
(sent with the "echo" argument)where further information and JSON with the entire 
event will be passed (without logic, which was mentioned in the task).

In the case of an incorrect type, an error is returned with information 
about what type of data the given field should contain.

NOTE: after cloning the repo and installing the Composer dependency "composer install" 
the System is started in the terminal from the project folder with the command "symfony server:start"
