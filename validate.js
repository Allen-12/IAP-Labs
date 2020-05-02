function validateForm()
{
    var fname = document.forms['user_details']['first_name'].value;
    var lname = document.forms['user_details']['last_name'].value;
    var city = document.forms['user_details']['city_name'].value;
    var uname = document.forms['user_details']['user_name'].value;
    var password = document.forms['user_details']['password'].value;

    if (fname == null || lname == "" || city == "" || uname == "" || password == "")
    {
        alert('All the required details have not been supplied');
        return false;
    }
    return true;
}