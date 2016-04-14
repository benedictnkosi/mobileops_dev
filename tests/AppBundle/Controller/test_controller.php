<?php
require_once(__DIR__.'/../../bootstrap.php');

/*required entities*/
/*required entities*/
require_once(__DIR__.'/../../src/AppBundle/Entity/LuFee.php');
require_once(__DIR__.'/../../src/AppBundle/Entity/Booking.php');
require_once(__DIR__.'/../../src/AppBundle/Entity/BookingFees.php');
require_once(__DIR__.'/../../src/AppBundle/Entity/BookingBookingStatus.php');
require_once(__DIR__.'/../../src/AppBundle/Entity/BookingAddress.php');
require_once(__DIR__.'/../../src/AppBundle/Entity/BookingTime.php');
require_once(__DIR__.'/../../src/AppBundle/Entity/User.php');
require_once(__DIR__.'/../../src/AppBundle/Entity/UserProfile.php');
require_once(__DIR__.'/../../src/AppBundle/Entity/LuAccountStatus.php');
require_once(__DIR__.'/../../src/AppBundle/Entity/LuBookingStatus.php');
require_once(__DIR__.'/../../src/AppBundle/Entity/LuUserRole.php');
require_once(__DIR__.'/../../src/AppBundle/Entity/Address.php');
require_once(__DIR__.'/../../src/AppBundle/Entity/UserUserService.php');
require_once(__DIR__.'/../../src/AppBundle/Entity/LuService.php');
require_once(__DIR__.'/../../src/AppBundle/Entity/LuServiceType.php');
require_once(__DIR__.'/../../src/AppBundle/Entity/BookingSummaryView.php');
require_once(__DIR__.'/../../src/AppBundle/Entity/BookingComments.php');
require_once(__DIR__.'/../../src/AppBundle/Entity/BookingServiceRegion.php');
require_once(__DIR__.'/../../src/AppBundle/Entity/BookingUserProfile.php');

require_once(__DIR__.'/../../src/AppBundle/Controller/controller_booking.php');
require_once(__DIR__.'/../../src/AppBundle/Controller/controller_booking_services.php');
require_once(__DIR__.'/../../src/AppBundle/Controller/controller_lookup.php');

//session_start ();
//$Booking    = $bookingController->getBookingByBookingID(3);

//$BookingEntity  = $entityManager->find('Booking', 3);

//$time_old = '2015-11-25 17:22:03'; //2015-11-19T15:30:00
//$date = new DateTime($time_old);
//echo $date->format('Y-m-d\TH:i:s');

initializeSession();

//getAllUserBookings($entityManager);
getBookingByBookingID($entityManager,1);
///getBookingFromSessionByID(1);
createBookingSummaryFromSession($entityManager,1);
getBookingSummary($entityManager,1);
getBookingAddress($entityManager,$booking_object);
//getBookingTimeDetails($entityManager);
//getBookingsInCalender($entityManager);
//bookingsInSession();
///$bookingID  = $entityManager->getRepository('Booking')->findBy(array('bookingId' => '3'));
//echo $Booking->getBookingId();
/*
							$_SESSION ['email_address'] = $user->getEmailAddress();
							$_SESSION ['user_login_status'] = 1;
							$_SESSION ['user_role'] = $user->getUserUserRole()->getName();
							$_SESSION ['user_id'] = $user->getUserId();
							$_SESSION ['firstname'] = $UserProfile->getFirstName();
							$_SESSION ['surname'] = $UserProfile->getSurname();
							$_SESSION ['phone_number'] = $UserProfile->getPhoneNumber();*/