<?php
/**
 * @var string $hash
 * @var string $password
 */

$confirmationUrl = route('confirm', ['hash' => $hash]);
?>

<h1>Apsveicam! Tavs pieteikums ir apstiprināts.</h1>
<p>Tava parole ir: {{ $password }}</p>
<p>Apstiprini e-pastu un nomaini savu paroli pēc iespējas ātrāk atverot šo saiti: <a href="{{$confirmationUrl}}}">{{$confirmationUrl}}</a></p>
<p>Uz tikšanos mēģinājumos<br><a href="{{ route('home') }}">kosist.lv</a></p>
