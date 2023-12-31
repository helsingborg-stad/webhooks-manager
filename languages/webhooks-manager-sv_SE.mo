��          �       �      �     �     �     �  6   �       B        a     h     p     y     �     �  ;   �     �     �  �  �  {  �          ;     D  c   U  8   �  #   �  4        K  �  i     	     	     -	  7   3	  
   k	  D   v	     �	     �	     �	     �	     �	     �	  =   �	     3
     @
  �  G
  �       �     �     �  P   �  5     #   T  4   x     �   Action Action Priority Active Create and manage webhooks from WordPress action hooks HTTP Method HTTP method used when making the request to the given payload url. Header Headers Inactive Lägg till rad POST Payload URL Priority passed to add_action for the selected action hook. Send payload Status Target url used for the request made when the selected hook is fired. The url can contain placeholders that will be replaced with hook arguments before request is sent. Placeholder format is the "$" character followed by the index of the hooks parameter. E.g. to use the first parameter in the hook, the placeholder should be "$1".
Note that only hook arguments of type string or int can be used by placeholders, all other will be omitted. This field allows you to define multiple HTTP headers for your requests. Each row represents a single header, and you should enter both the header name and its corresponding value in the same row. Use the "Add Row" button to create additional headers as needed. For example, to include an "Authorization: Basic 123" header, add a row with "Authorization: Basic 123" in the field. Thor Brink @ Helsingborg Stad Webhooks Webhooks Manager Wether to send the data passed to the selected action hook in the request to the payload ur or not. WordPress hook that determines when to fire the webhook. https://github.com/helsingborg-stad https://github.com/helsingborg-stad/webhooks-manager https://my.client.site/api/$1 Project-Id-Version: Webhooks Manager
Report-Msgid-Bugs-To: 
POT-Creation-Date: 2023-12-06 09:36+0000
PO-Revision-Date: 2023-12-06 10:08+0000
Last-Translator: 
Language-Team: Svenska
Language: sv_SE
Plural-Forms: nplurals=2; plural=n != 1;
MIME-Version: 1.0
Content-Type: text/plain; charset=UTF-8
Content-Transfer-Encoding: 8bit
X-Generator: Loco https://localise.biz/
X-Loco-Version: 2.6.6; wp-6.4.1
X-Domain: webhooks-manager Action Action Prioritet Aktiv Skapa och hantera webhooks från WordPress action hooks HTTP-metod HTTP-metod som används när begäran görs till den angivna url:en. Header Headers Inaktiv Lägg till rad POST URL för anrop Prioritet som skickas till add_action för din valda webhook. Skicka anrop Status Url som används för anrop som görs när den valda webhooken körs. Url:en kan innehålla platshållare som erstätts med hook-argument innan begäran skickas. Platshållarens format är tecknet "$" följt av index för parametern i hooken. Om du t.ex. vill använda den första parametern i hooken ska platshållaren vara "$1".
Observera att endast hook-argument av typen string eller int kan användas av platshållare, alla andra utelämnas. I detta fält kan du definiera flera HTTP-headers för dina anrop. Varje rad representerar en enskild header, och du bör ange både headernamnet och dess motsvarande värde på samma rad. Använd knappen "Lägg till rad" för att skapa ytterligare headers efter behov. Om du till exempel vill inkludera en "Authorization: Basic 123" lägger du till en rad med "Authorization: Basic 123" i fältet. Thor Brink @ Helsingborg Stad Webhooks Webhooks Manager Om de data som skickas till vald action hook ska skickas med i anropet eller ej. WordPress-hook som avgör när webhooken ska skickas. https://github.com/helsingborg-stad https://github.com/helsingborg-stad/webhooks-manager https://my.client.site/api/$1 