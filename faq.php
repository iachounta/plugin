<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * @package   local_analytics
 * @copyright 2020, You Name <your@email.address>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__. "/graph-php-main/graph-php.class.php");
require_once(__DIR__. "/../../config.php");
require_once(__DIR__. "/layout.php");

$PAGE->set_url(new moodle_url("/local/analytics/faq.php"));

?>


<!-- Layout -->
<head>
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        span.blueColor {
            color:#004C93;
            font-family:Arial;
        }
        span.blackColor {
            color:black;
            font-weight:bold;
            font-family:Arial;
        }
        .center {
            margin: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }
        .divAlign{
            position:absolute;
            width:45px;
            height:45px;
            left:15px;
            border-radius: 15px;
        }
    </style>
</head>


    <?php

    //Read Course ID, Startdate, Enddate (Use "Course Search" input)
    global $DB;
    $course_name = required_param("course", PARAM_TEXT);
    $sql = "SELECT c.* FROM {course} c WHERE upper(c.fullname) like upper(?)";
    $records = $DB->get_records_sql($sql, ['%'.$course_name.'%']);

    $startDate = null;
    $startDateEpoch = null;
    $endDateEpoch = null;
    $courseId = null;
    if (count($records) > 0) {
        foreach ($records as $course) {
            $courseId = $course->id;
            $course_name = $course->fullname;
            $startDateEpoch = $course->startdate;
            $endDateEpoch = $course->enddate;
            $startDate = date('d/m/Y', $course->startdate);
        }
    }
    else {
        //Error "Course not found"
        echo "<script>alert('There is no Course with the name: \"$course_name\"')</script>";
        return(null);
    }

?>

<!-- Questions -->
    <div style="color:black;font-family:arial;position:absolute; width: 90%; left:5%; top:10%; text-align:center;margin:auto" >
        <h1>Current most frequently asked questions</h1>
        <br>
        <div style="display:inline-block; background-color: white; width:80%; padding: 1% 3%;">
            <h2>Can i change the colour or design of the Dashboard?</h2>
            <p>TheLorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
        </div>
        <br><br><br>
        <div style="display:inline-block; background-color: white; width:80%; padding: 1% 3%;">
            <h2>Is this project open source?</h2>
            <p>TheLorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
        </div>
        <br><br><br>
        <div style="display:inline-block; background-color: white; width:80%; padding: 1% 3%;">
            <h2>Why does this plugin only work on Moodle?</h2>
            <p>TheLorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. </p>
        </div>
    </div>

    </body>

<?php

