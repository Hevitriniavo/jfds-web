document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');
    const activityModal = document.getElementById('activityModal');
    const closeModalBtn = document.querySelector('.close');

    let calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        editable: true,
        events: [],
        dateClick: function (info) {
        },
        eventClick: function (info) {
            const eventId = info.event.id;
            console.log(info)

            fetch(`/api/activity_details?activity_id=${eventId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(activityJson => {
                    console.log(activityJson)
                    showActivityDetails(activityJson);
                    activityModal.style.display = 'block';
                })
                .catch(error => console.error('Error fetching event details:', error));
        }
    });


    closeModalBtn.onclick = function () {
        activityModal.style.display = 'none';
    };

    function showActivityDetails(json) {
        const activityDetails = document.getElementById('modalContent');
        activityDetails.innerHTML = `
        <div style="padding: 20px; font-family: Arial, sans-serif;">
            <strong style="color: #333;">Organisateur:</strong> ${json.organizer_first_name} ${json.organizer_last_name}<br>
            <strong style="color: #333;">Nom d’activité:</strong> ${json.activity_name}<br>
            <strong style="color: #333;">Date:</strong> ${new Date(json.activity_start_date).toLocaleString()}<br>
            <strong style="color: #333;">Lieu:</strong> ${json.activity_location}<br>
            <strong style="color: #333;">Description:</strong> ${json.activity_description}<br>
        </div>
    `;

        document.getElementById('activityModal').style.display = 'block';
    }

    fetch('/api/activities')
        .then(response => response.json())
        .then(data => {
            data.forEach(activity => {
                calendar.addEvent({
                    id: activity.id,
                    title: activity.name,
                    start: activity.start_date,
                    end: activity.end_date,
                    allDay: true,
                    extendedProps: {
                        organizer: activity.organizer_first_name + ' ' + activity.organizer_last_name,
                        description: activity.description,
                        location: activity.location
                    }
                });
            });
        })
        .catch(error => console.error('Error fetching activities:', error));

    calendar.render();
});