$(function() {
    var loc = window.location.href; // returns the full URL
    if(/web_design.php/.test(loc)) {
        $('#home, #services, #about, #contact').removeClass('active');
        $('#portfolio').addClass('active');
    }
    if(/print_design.php/.test(loc)) {
        $('#home, #services, #about, #contact').removeClass('active');
        $('#portfolio').addClass('active');
    }
    if(/ux_design.php/.test(loc)) {
        $('#home, #services, #about, #contact').removeClass('active');
        $('#portfolio').addClass('active');
    }
    if(/services.php/.test(loc)) {
        $('#home, #portfolio, #about, #contact').removeClass('active');
        $('#services').addClass('active');
    }
    if(/about.php/.test(loc)) {
        $('#home, #portfolio, #services, #contact').removeClass('active');
        $('#services').addClass('active');
    }
    if(/contact.php/.test(loc)) {
        $('#home, #portfolio, #services, #about').removeClass('active');
        $('#services').addClass('active');
    }
}); 