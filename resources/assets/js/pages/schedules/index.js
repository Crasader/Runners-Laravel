/**
* Script fot the index page of schedules
* Display the calendar
*
* @author Bastien Nicoud
*/
// jQuery is needed for fullcalendar
import $ from 'jquery'
import 'fullcalendar'
import 'fullcalendar/dist/locale/fr-ch.js'

$(function () {
  // Initialize the calendar
  $('#schedule-calendar').fullCalendar({
    locale: 'fr-ch',
    // Sets the default view of the calendar
    defaultView: 'agendaWeek',
    // Options for the view
    allDaySlot: false,
    slotEventOverlap: false,
    slotLabelFormat: 'H:mm',
    scrollTime: '10:00:00',
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
        alert("Un erreur c'est produite en récupérant les événements")
      }
    },
    eventClick: function (calEvent, jsEvent, view) {
      window.location.href = calEvent.show_route
    }
  })
})
