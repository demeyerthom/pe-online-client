#PE-Online Client

Deze package is bedoeld om het verwerken van presenties naar PE-Online te vergemakkelijken.

###Configuratie

```php
require 'vendor/autoload.php';

$settings = [
    'userID' => 1,
    'userRole' => 'EDU',
    'userKey' => 'secret',
    'orgID' => 19,
    'settingOutput' => 1,
    'emailOutput' => 'test@test.nl',
    'languageID' => 1,
    'defaultLanguageID' => 1
];

$service = new Demeyerthom\PeOnline\Service($settings);

$attendances = [
    new Demeyerthom\PeOnline\Models\Attendance(
        [
            'PECourseID' => 9471,
            'externalPersonID' => 39054148101,
            'externalmoduleID' => 'Module_A',
            'endDate' => '2008-06-09T13:08:13.0000000+02:00'
        ]
    )
];

$summary = $service->writeAttendance($attendances);

echo $summary->accepted[0]->course;
echo $summary->accepted[0]->person;
echo $summary->accepted[0]->date;

### response
9471
39054148101
2017-01-21T20:39:13.0000000+02:00
```

###Documentatie
Zie de [documentatie](documents/PE%20(GAIA)%20-%20Webservice%20e-learning%20en%20Fysiek%20presenties%20-%20AlgemeenV01.doc) van PE voor algemene informatie over de API en de mogelijke settings voor het service-object.

Zie de [organisatie-lijst](documents/org_lijst.pdf) voor de verschillende mogelijke organisaties en hun ids.

###To do
- Meer tests schrijven
- Exception toevoegen voor slechte XML-error
- Het Attendance-object uitbreiden met de mogelijkheid om te valideren op de verschillende wegschrijf-alternatieven.
- Extra functies op het Summary-object om filteren en groepen van subselecties mogelijk te maken