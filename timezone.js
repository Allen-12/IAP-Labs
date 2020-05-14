$(document).ready(function ()
{
    // Returns the number of minutes behind or ahead of GMT
    let offset = new Date().getTimezoneOffset();
    // Returns the number of milliseconds that have elapsed since 1970-01-01
    let timestamp = new Date().getTime();
    // Convert the time to Universal Time Coordinated/Universal Coordinated Time
    let utcTimestamp = timestamp + (60000 * offset);

    $('#timeZoneOffset').val(offset);
    $('#utcTimestamp') .val(utcTimestamp);
});