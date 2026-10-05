const overlay = document.getElementById('overlay')

if (overlay) {
  overlay.addEventListener('click', () => {
    const overlay = document.getElementById('overlay')
    overlay.classList.add('opacity-0')
    setTimeout(() => {
      overlay.classList.add('remove')
    }, 1000)
  })  
}

const filter = () => {
  const doc = document.getElementById('home')
  const currentScroll = Math.max(window.pageYOffset, document.documentElement.scrollTop, document.body.scrollTop)
  const filterStartHeight = window.innerHeight / 3
  if (currentScroll > filterStartHeight) {
    doc.classList.remove('light')
    doc.classList.add('dark')
  } else {
    doc.classList.remove('dark')
    doc.classList.add('light')
  }
}

window.addEventListener('scroll', filter)

/* smooth scroll */
document.getElementById('scrollTop')
  ? document.getElementById('scrollTop').addEventListener('click', () => {
      window.scrollTo({
        top: 0,
        behavior: 'smooth',
      })
    })
  : false

/* Google Map */
function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    center: { lat: 37.464904, lng: 138.829251 },
    zoom: 13,
    disableDefaultUI: true,
    // 以下をすこし修正
    // https://github.com/googlemaps/js-samples/blob/master/samples/style-array/src/index.ts
    styles: [
      { elementType: 'geometry', stylers: [{ color: '#111111' }] },
      { elementType: 'labels.text.stroke', stylers: [{ color: '#111111' }] },
      { elementType: 'labels.text.fill', stylers: [{ color: '#746855' }] },
      {
        featureType: 'administrative.locality',
        elementType: 'labels.text.fill',
        stylers: [{ color: '#d59563' }],
      },
      {
        featureType: 'poi',
        elementType: 'labels.text.fill',
        stylers: [{ color: '#d59563' }],
      },
      {
        featureType: 'poi.park',
        elementType: 'geometry',
        stylers: [{ color: '#263c3f' }],
      },
      {
        featureType: 'poi.park',
        elementType: 'labels.text.fill',
        stylers: [{ color: '#6b9a76' }],
      },
      {
        featureType: 'road',
        elementType: 'geometry',
        stylers: [{ color: '#38414e' }],
      },
      {
        featureType: 'road',
        elementType: 'geometry.stroke',
        stylers: [{ color: '#212a37' }],
      },
      {
        featureType: 'road',
        elementType: 'labels.text.fill',
        stylers: [{ color: '#9ca5b3' }],
      },
      {
        featureType: 'road.highway',
        elementType: 'geometry',
        stylers: [{ color: '#746855' }],
      },
      {
        featureType: 'road.highway',
        elementType: 'geometry.stroke',
        stylers: [{ color: '#1f2835' }],
      },
      {
        featureType: 'road.highway',
        elementType: 'labels.text.fill',
        stylers: [{ color: '#f3d19c' }],
      },
      {
        featureType: 'transit',
        elementType: 'geometry',
        stylers: [{ color: '#2f3948' }],
      },
      {
        featureType: 'transit.station',
        elementType: 'labels.text.fill',
        stylers: [{ color: '#d59563' }],
      },
      {
        featureType: 'water',
        elementType: 'geometry',
        stylers: [{ color: '#17263c' }],
      },
      {
        featureType: 'water',
        elementType: 'labels.text.fill',
        stylers: [{ color: '#515c6d' }],
      },
      {
        featureType: 'water',
        elementType: 'labels.text.stroke',
        stylers: [{ color: '#17263c' }],
      },
    ],
  })
  var latlng = new google.maps.LatLng(37.464904, 138.829251)
  var marker = new google.maps.Marker({
    position: latlng,
    map: map,
  })
  var infoWindow = new google.maps.InfoWindow({
    // 吹き出しの追加
    content:
      '<div class="info">長岡リリックホール<a href="https://www.google.co.jp/maps/dir//%E9%95%B7%E5%B2%A1%E3%83%AA%E3%83%AA%E3%83%83%E3%82%AF%E3%83%9B%E3%83%BC%E3%83%AB%E3%80%81%E3%80%92940-2108+%E6%96%B0%E6%BD%9F%E7%9C%8C%E9%95%B7%E5%B2%A1%E5%B8%82%E5%8D%83%E7%A7%8B%EF%BC%93%E4%B8%81%E7%9B%AE%EF%BC%91%EF%BC%93%EF%BC%95%EF%BC%96%E2%88%92%EF%BC%96/@37.4649032,138.8269598,17z" target="_blank" style="display:block;">Google Map で開く<i class="fa fa-external-link" aria-hidden="true"></i></a></div>',
  })
  marker.addListener('click', function () {
    // マーカーをクリックしたとき
    infoWindow.open(map, marker) // 吹き出しの表示
  })
}
