function render_opening_hours() {
    setlocale(LC_TIME, "en_US.UTF-8");
    
    $current_day = strftime('%A');
    $current_time = date('H:i');

    $opening_hours = array(
        'Monday'    => array('08:00-13:00', '15:00-18:00'),
        'Tuesday'   => array('09:00-19:00'),
        'Wednesday' => array('09:00-19:00'),
        'Thursday'  => array('09:00-19:00'),
        'Friday'    => array('08:00-13:00', '15:00-18:00'),
        'Saturday'  => array('11:00-16:00'),
        'Sunday'    => 'Closed'
    );

    $output = '<table>';
    foreach ($opening_hours as $day => $hours) {
        $output .= '<tr>';
        if ($day === $current_day) {
            if ($hours != 'Closed') {
                $is_open = false;
                $closing_soon = false;
                $reopening_later = false;
                $next_opening_time = '';
                foreach ($hours as $range) {
                    list($start, $end) = explode('-', $range);
                    if ($current_time >= $start && $current_time <= $end) {
                        $is_open = true;
                        $closing_time = date('H:i', strtotime($end) - 3600);  // 1 hour before closing
                        if ($current_time >= $closing_time) {
                            $closing_soon = true;
                        }
                        break;
                    } elseif ($current_time < $start) {
                        if (!$reopening_later) {
                            $next_opening_time = $start;
                            $reopening_later = true;
                        }
                    }
                }
                if ($is_open && $closing_soon) {
                    $output .= "<td>{$day}:</td><td style='color: darkorange;'>Closing soon</td>";
                } elseif ($reopening_later) {
                    $output .= "<td>{$day}:</td><td>Reopening at {$next_opening_time}</td>";
                } elseif ($is_open) {
                    $output .= "<td>{$day}:</td><td style='color: darkgreen;'>Open</td>";
                } else {
                    $output .= "<td>{$day}:</td><td>" . implode(' and ', $hours) . "</td>";
                }
            } else {
                $output .= "<td>{$day}:</td><td style='color: darkred;'>Closed</td>";
            }
        } else {
            if ($hours != 'Closed') {
                $output .= "<td>{$day}:</td><td>" . implode(' and ', $hours) . "</td>";
            } else {
                $output .= "<td>{$day}:</td><td style='color: darkred;'>Closed</td>";
            }
        }
        $output .= '</tr>';
    }
    $output .= '</table>';

    return $output;
}
add_shortcode('opening_hours', 'render_opening_hours');
