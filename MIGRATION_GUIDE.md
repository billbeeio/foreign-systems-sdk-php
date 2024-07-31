# Anleitung Migration von Custom Shop SDK zu Foreign Systems SDK

Für die Migration vom Custom Shop SDK zum Foreign Systems SDK sind die folgenden Schritte nötig:

1. Austausch des SDKs
2. Implementierung des Repositories für die Provisioning Details
3. Migration bestehender Custom Shop SDK Repositories
4. Nutzung eines Authentifikators für die Zugriffskontrolle
5. Registrierung von RequestHandlern, Repositories und Authenifikatoren

## 1. Austausch des SDKs

Wenn zuvor das Custom Shop SDK genutzt wurde, muss die Abhängigkeit zu diesem Paket zunächst entfernt werden:

```sh
composer remove billbee/custom-shop-api
```

Das Foreign Systems SDK muss installiert werden:

```sh
composer require billbee/foreign-systems-sdk
```

## 2. Implementierung des Repositories für die Provisioning Details

Die Implementierung des Repositories für die Provisioning Details ist Pflicht und wird benötigt, um die Anbindung zwischen Billbee und dem Fremdsystem herzustellen.

Die Provisioning Details sind als eine Beschreibung des Fremdsystems anzusehen und geben insbesondere Auskunft darüber, welche von Billbee anbindbaren Teil-Systeme von dem Fremdsystem unterstützt werden und welche Form der Autorisierung genutzt werden soll.

Um das Repository für die Provisioning Details umzusetzen muss das Interface

```php
Billbee\ForeignSystemsSdk\Provisioning\Repository\ProvisioningRepositoryInterface
```

implementiert werden. Dieses gibt genau eine zu implementierende Methode vor:

```php
getProvisioningDetails(GetProvisioningDetailsRequest $request): ProvisioningDetails;
```

Die Methode erhält der Einheitlichkeit halber ein Request-Objekt, welches aber für die Implementierung der Methode nicht weiter benötigt wird.

Die Methode muss ein Objekt des Typs `ProvisioningDetails` zurückgeben. Nachfolgend eine Beispiel-Implementierung.

_Hinweis:_ Das Beispiel erläutert die wichtigsten Felder, erhebt aber keinen Anspruch auf Vollständigkeit. Falls weitere Details benötigt werden bitte in den  PHPDoc-Kommentare im Quellcode nachschauen oder gerne nachfragen unter support@billbee.io.)

```php
public function getProvisioningDetails(GetProvisioningDetailsRequest $request): ProvisioningDetails
{
    return (new ProvisioningDetails())
        ->setName("Sample Foreign System")
        ->setCommonHeaders(["x-common-header" => "I will be sent for all subsystems"])
        ->setAuthConfig(new BasicAuthConfig())
        ->setSubsystems([(new Subsystem())
            ->setId(0,)
            ->setName("Channel Subsystem")
            ->setEndpoint("http://lcl.custom-web-shop:1337")
            ->setAuthConfig(null)
            ->setType(SubsystemTypeEnum::Channel)
            ->setSupportedFeatures([])
            ->setConfigurationFields([
                (new ConfigurationField())
                    ->setCaption("Basisauthentifizierung Benutzername")
                    ->setName("basicAuth::user")
                    ->setType(FieldTypeEnum::Text)
                    ->setIsRequired(true,)
                    ->setAppendToRequests(true),
                (new ConfigurationField())
                    ->setCaption("Basisauthentifizierung Passwort")
                    ->setName("basicAuth::password")
                    ->setType(FieldTypeEnum::Password)
                    ->setIsRequired(true,)
                    ->setAppendToRequests(true)
            ])
            ->setHeaders([
                "x-subsystem-header" => "I will only be sent for this subsystem",
                "x-header-with-config-value" => "Replace me: {basicAuth::user}"
            ])
        ]);
}
```

Hier werden die Provisioning Details für ein Fremdsystem namens `Sample Foreign systeme` zurückgegeben.

Als `CommenHeaders` wird ein HTTP Header `x-common-header` gesetzt. Dieser Header wird bei allen Requests an alle Sub-Systeme mitgesendet.

Als AuthConfig wird ein Objekt des Typs `BasicAuthConfig` gesetzt, das vorgibt, dass die Autorisierung für jede API-Anfrage per HTTP Basisauthentifizierung erfolgt. Zukünftig soll auch eine Autorisierung per OAuth angeboten werden. In diesem Fall wäre hier ein Objekt des Typs `OAuthConfig` zu setzen.

Über `setSubsystems` werden die unterstützten Sub-Systeme definiert. In diesem Fall wird genau ein Sub-System unterstützt mit der ID 0 (jedes Subsystem muss eine eindeutige ID haben, um in Billbee referenziert werden zu können) und dem Namen `Channel Subsystem`.

Das Sub-System ist über die Basis URI `http://lcl.custom-web-shop:1337` erreichbar. Es hat keine eigene Autorisierung, weshalb `setAuthConfig` den Wert `null` erhält.

Der Typ des Sub-Systems wird auf `SubsystemTypeEnum::Channel` gesetzt. Ein Sub-System dieses Typs erlaubt den Abruf von Bestellungen.

Per `setSupportedFeatures` kann noch fein-granularer eingestellt werden, welche der Billbee-internen Features eine Channel-Anbindung unterstützt werden. In diesem Fall wird keines der Features unterstützt (leeres Array).

Per `setConfigurationFields` können Felder definiert werden, die der Billbee-User in den Anbindungseinstellungen in Billbee setzen kann. In diesem Fall werden zwei Felder definiert, in die der User die Zugangsdaten für die HTTP Basisauthentifizierung eintragen muss. Diese beiden Felder müssen die speziellen Namen `basicAuth::user` und `basicAuth::password` besitzen.

Für Eingabefelder legt `setIsRequired` fest, ob es sich um ein Pflichtfeld handelt. Über `setAppendToRequests` wird festgelegt, ob die Werte der Felder in einem speziellen `config`-Objekt in den JSON-Daten eines jeden API Requests mitgesendet werden.

Falls für eine Sub-System bestimmte HTTP-Header in den Anfragen gesetzt werden sollen, können diese für das Sub-System per `setHeader` übergeben werden.

Die Sub-System-Header bieten außerdem die Möglichkeit, bestimmte Konfigurationswerte als HTTP-Header zu übergeben, indem Platzhalter verwendet werden. Der Platzhalt muss dann der Name des Konfigurationsfelds sein. Bei folgendem Header wird beispielsweise der Benutzername für die Basisauthentifizierung `(x-header-with-config-value, Replace me: {basicAuth::user})` eingesetzt.

## 3. Migration bestehender Custom Shop SDK Repositories

Analog zum Custom Shop SDK müssen auch beim Foreign System SDK Repositories implementiert werden, die die Daten für die entsprechenden API-Aktionen liefern.

Wie auch beim Custom Shop SDK stellt das Foreign System SDK dafür bestimmte Interfaces zur Verfügung, die implementiert werden müssen. So muss für den Abruf von Bestellungen beispielsweise das Interface `OrderRepositoryInterface` implementiert werden.

In der aktuellen Version unterstützt das Foreign System SDK Aktionen für die folgenden Ressourcen:

1. Bestellungen (Interface: `OrderRepositoryInterface`)
2. Produkte  (Interface: `ProductRepositoryInterface`)

Nachfolgend wird exemplarisch die Migration des Repositories für Bestellung gezeigt.

An dieser Stelle wird nicht auf die vollständige Implementierung eingegangen. Sie erfolgt analog zu der für das Custom Shop SDK und kann im Abschnitt "OrderRepositoryInterface implementieren" in der Dokumentation (https://www.billbee.io/blog/custom-shop-api-sdk-verwenden) nachgelesen werden.

Die Migration wird anhand der Repository-Methode `getOrders` zum Abruf von Bestellungen erläutert. Das Interface `OrdersRepositoryInterface` aus dem Custom Shop SDK definiert für diese Methode folgende Signatur:

```php
public function getOrders(int $page, int $pageSize, DateTime $modifiedSince): PagedData;
```

Die Methode erhält die Nummer der Seite die zurückgegeben werden soll (`$page`), die Anzahl von Bestellungen pro Seite (`$pageSize`) und ein Datum nach dem die Bestellungen modifiziert worden sein müssen (`$modifiedSince`). Die Methode muss eine Objekt vom Typ `PagedData` zurückgeben.

Das Interface `OrderRepositoryInterface` des Foreign System SDKs hat ebenfalls eine GetOrders-Methode allerdings mit folgender Signatur:

```php
public function getOrders(GetOrderListRequest $request): PagedData;
```

Statt der o.g. Parameter wird ein Request-Objekt übergeben. Diesem können wie folgt die benötigten Parameter entnommen werden:

```php
$page = $payload->getPayload()->getPage();
$pageSize = $payload->getPayload()->getPerPage();
$modifiedSince = $payload->getPayload()->getStartDate();
```

Der Rest der Methode aus dem Repository für das Custom Shop SDK kann unverändert übernommen werden. Auch der Rückgabewert ist ein PagedData-Objekt (, das nun allerdings aus dem ForeignSystems-Paket kommet, ansonsten aber das gleiche ist).

Die Migration der anderen Repositories z.B. `ProductRepositoryInterface` und zugehöriger Methoden erfolgen analog.

## 4. Nutzung eines Authentifikators für die Zugriffskontrolle

Für die Zugriffskontrolle nutzt das Foreign Systems SDK Authentifikatoren.

Das SDK kommt zu Demonstrationszwecken mit einem Authentifikator für die HTTP Basisauthentifizierung. Um diesen zu nutzen, muss die `BasicAuthConfig` als AuthConfig für das Fremdsystem gesetzt werden (siehe PHP-Code-Beispiel in Abschnitt 2) und ein Objekt des Typs `BasicAuthAuthenticator` muss mit den Zugangsdaten initialisiert und an den `RequestHandlerPool` übergeben werden (siehe dazu PHP-Code-Beispiel im nächsten Abschnitt).

Für komplexere Formen der Autorisierung z.B. separate Basisauthentifizierungs-Zugangsdaten pro User oder die Autorisierung per OAuth Access Tokens müssen eigene Authentifikatoren implementiert werden. Dazu stellt das SDK das Interface `AuthenticatorInterface` zur Verfügung. Das Interface definiert eine Methode `isAuthorized` die implementiert werden muss.

## 5. Registrierung von RequestHandlern, Repositories und Authenifikatoren

Analog zum Custom Shop SDK müssen auch beim Foreign Systems SDK entsprechende RequestHandler instanziert und bei einem RequestHandlerPool registriert werden.

Dabei werden den RequestHandlern die Repositories übergeben, über die sie die entsprechenden Daten beziehen können.

Weiterhin wird beim RequestHandlerPool ein Authenticator registriert, der die Autorisierung der Zugriffe regelt.

Nachfolgend ein Code-Beispiel in dem Handler für ProvisioningDetails und Channel inklusive zugehöriger Repositories registriert werden. Für die Autorisierung wird ein BasicAuthAuthenticator an den RequestHandlerPool übergeben:

```php
$handler = new RequestHandlerPool(new BasicAuthAuthenticator("john", "12345"));

$handler->addHandler(new ProvisioningRequestHandler(new ProvisioningRepository()));
$handler->addHandler(new OrderRequestHandler(new OrderRepository()));

$response = $handler->handle($request);

$response->send();

```





