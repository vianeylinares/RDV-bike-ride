# RDV event registration

This project goal was to create a custom WordPress plugin for a bike ride event registration. The attendees register at the frontend with a custom form. Once the attendee enters the required data and the custom form it’s sent, the system will record the attendee’s data in the DB. Then the system will automatically fill the event custom PDF form. Once the custom PDF form is ready, the system sends it by email to the attendee.


### RDV admin

The plugin adds two custom post-types: participant and event.

#### ‘participant’

This custom post-type handles the bike ride attendees' data. This post-type isn’t available in menu options as it shouldn’t be edited or deleted by editor or administrator users.

The admin page for each ‘participant’ presents a meta-box that displays all the data entered by the attendee at the frontend custom form.

![Alt text](https://vl-portfolio-images.s3.us-west-2.amazonaws.com/admin-attendee-data.jpg)

#### ‘event’

This custom post-type handles the bike ride event data. This post-type is available in menu options to create new entries for each yearly event.

This custom post-type presents two meta-boxes:
The first meta-box shows the event frontend enable option (checkbox) and a full image of the custom form that will later become a PDF document.
The second meta-box shows a list that presents the registered attendees and a few general details. The attendee’s name will link to an admin page that will feature more detailed information about the attendee. This meta-box also shows a button that allows the admin user to download all the attendees’ data in CSV format.

![Alt text](https://vl-portfolio-images.s3.us-west-2.amazonaws.com/admin-event-data.jpg)

The image section in the first meta-box also presents eleven drag and drop spaces (in red). These spaces represent the fields in the custom registration form and can be moved around by the admin/manager user. The spaces objective is to be placed/set in different positions according to the field distribution established by the hardcopy registration form design. This way, the form fields can be placed where it should be necessary and, without mattering the hardcopy registration form design.

[![IMAGE ALT TEXT](https://vl-portfolio-images.s3.us-west-2.amazonaws.com/rdv-event-creation.jpg)](http://www.youtube.com/watch?v=rnr7bD40A3A "Bike Ride event registration plugin - admin sample view")


### RDV frontend

If the current event is enabled, two different forms are displayed:

![Alt text](https://vl-portfolio-images.s3.us-west-2.amazonaws.com/frontend-forms.jpg)

The first form initiates the registration process for a new attendee. If the attendee's email is already registered, the system will throw an error message.

The second form emails the filled registration form to an already registered attendee. If the attendee's email isn’t registered, the system will throw an error message.

If there are no errors in either form, the system will generate the custom PDF form containing the attendee’s data. The system will email the PDF document to the attendee.

[![IMAGE ALT TEXT](https://vl-portfolio-images.s3.us-west-2.amazonaws.com/RDV-frontend.jpg)](http://www.youtube.com/watch?v=NAb_7mzuId4 "Bike Ride event registration plugin - frontend sample view")


### Other details

The plugin was developed with:
<ul>
<li>WordPress</li>
<li>PHP 5.6</li>
<li>HTML</li>
<li>JavaScript/jQuery</li>
<li>CSS</li>
<li>FPDF</li>
<li>FPDI</li>
</ul>

Company: Click-MX

This application was initially released in 2016.