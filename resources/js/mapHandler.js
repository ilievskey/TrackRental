document.addEventListener('DOMContentLoaded', function (){
    updateLocation();
});

document.getElementById('pickup_location').addEventListener('change', function (){
    updateLocation();
});

function updateLocation(){
    var selectedLocation = document.getElementById('pickup_location').value;
    var mapEmbed = '';

    switch (selectedLocation){
        case 'GTC':
            mapEmbed = '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d325.91519004698904!2d21.435175936046758!3d41.99401817776758!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x13541582a7838675%3A0xd3f994bfa562b4e8!2z0J_QsNGA0LrQuNC90LMg0JPQotCm!5e1!3m2!1smk!2smk!4v1733527418695!5m2!1smk!2smk" class="lemap" style="border:0; " allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';
            break;

        case 'Skopje Aerodrom':
            mapEmbed = '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3689.229039440872!2d21.62473487659322!3d41.96086826022731!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x135439a56adf1149%3A0x8365b8134bf16f18!2z0J_QsNGA0LrQuNC90LMg4oCe0JzQtdGT0YPQvdCw0YDQvtC00LXQvSDQsNC10YDQvtC00YDQvtC8INCh0LrQvtC_0ZjQteKAnCDQodC10LLQtdGA0L3QsCDQnNCw0LrQtdC00L7QvdC40ZjQsA!5e1!3m2!1smk!2smk!4v1733527750765!5m2!1smk!2smk" class="lemap" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';
            break;

        case 'Vero':
            mapEmbed = '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1421.593001079136!2d21.403482738042587!3d41.9966604650759!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x135415003b7948a7%3A0x62124843356392fa!2zVmVybyAtIFRhZnRhbGlkemUgUGFya2luZyBMb3QgLyDQn9Cw0YDQutC40L3QsyDQktC10YDQviAtINCi0LDRhNGC0LDQu9C40Z_QtQ!5e1!3m2!1smk!2smk!4v1733528009765!5m2!1smk!2smk" class="lemap" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';
            break;

        default:
            mapEmbed = '<p>Please choose a location from the dropdown</p>';
    }

    document.getElementById('mapContainer').innerHTML = mapEmbed;
}
