<?php

if (!function_exists('formatPhone')) {
  function formatPhone($phoneNumber)
  {
    $formattedPhone = substr($phoneNumber, 0, 4) . '-' . substr($phoneNumber, 4, 4) . '-' . substr($phoneNumber, 8, 4);
    return $formattedPhone;
  }
}
