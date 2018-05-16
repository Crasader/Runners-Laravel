/**
* Script fot the index page of schedules
* Display the calendar
*
* @author Bastien Nicoud
*/
// jQuery is needed for fullcalendar
import $ from 'jquery'
import 'fullcalendar'

$(function () {
  // Initialize the calendar
  $('#schedule-calendar').fullCalendar({
    // Sets the default view of the calendar
    defaultView: 'agendaWeek',
    // Specify the source to load events vie ajax request
    events: {
      url: '/schedules/events',
      type: 'POST',
      headers: {
        'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
        'X-Requested-With': 'XMLHttpRequest',
        'Content-Type': 'application/json'
      },
      error: function () {
        alert('There was an error while fetching events!')
      }
    }
  })
})
