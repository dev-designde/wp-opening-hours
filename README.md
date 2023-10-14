

# wp-opening-hours

This script presents a PHP function for WordPress, offering a streamlined solution to display a business's opening hours along with the current operational status, based on the day and time. It stands as an optimum alternative to installing additional plugins or incurring extra costs. Embodying simplicity, modernity, and minimalism, this function is fully customizable and is designed to be compatible with nearly every version of WordPress.



## Features

- Display opening hours in a table format.
- Dynamically indicate whether the business is currently open, closed, closing soon, or reopening later.
- Style indicators for better visual feedback.
- Shortcode integration for easy implementation on WordPress pages.




## Change Timezone


    date_default_timezone_set('Europe/Berlin');  // Set timezone
    setlocale(LC_TIME, "en_US.UTF-8");
    
    $current_day = strftime('%A');
    $current_time = date('H:i');


    
## Usage

Copy the `render_opening_hours` function into your WordPress theme's `functions.php` file or a custom plugin.

Use the `[sprechzeiten-dev-design]` shortcode wherever you want to display the opening hours on your website.

## Customization

The render_opening_hours function can be customized to match your desired opening hours by editing the $opening_hours array.
Styles can be adjusted by modifying the style attribute within the td tags or by applying CSS classes and styling them in your theme's stylesheet.
