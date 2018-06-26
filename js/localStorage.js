
function toDataURL(src, callback) {
  var img = new Image();
  img.crossOrigin = "anonymous";
  img.onload = function() {
    var canvas = document.createElement('CANVAS');
    var ctx = canvas.getContext('2d');
    var dataURL;
    canvas.height = this.naturalHeight;
    canvas.width = this.naturalWidth;
    ctx.drawImage(this, 0, 0);
    dataURL = canvas.toDataURL();
    callback(dataURL);
  };
  img.src = src;
  if (img.complete || img.complete === undefined) {
    img.src = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";
    img.src = src;
  }
}


function ImageLoader(imageId, localStorageKey, imgSrc, imgAlt) {
  this.imgAlt          = imgAlt;
  this.imageId         = imageId;
  this.localStorageKey = localStorageKey;
  this.imgSrc          = imgSrc;
}

ImageLoader.prototype.loadImage = function() {
    console.log(this.imageId);
    console.log(this.localStorageKey);
    console.log(this.imgSrc);
    var that = this;
    var img = document.getElementById(this.imageId);
    if (localStorage.getItem(this.localStorageKey) !== null) {
      img.src = localStorage.getItem(this.localStorageKey);
      img.alt = this.imgAlt;
      console.log("Pobrałem obrazek z local storage; key: " + this.localStorageKey)
    } else {
      console.log("Przekształcam obraz "+that.imgSrc);
      toDataURL(
        that.imgSrc,
        function(dataUrl) {
          console.log("Załadowałem obrazek z sieci; adres: "+that.imgSrc);
          console.log(dataUrl.slice(0,100));
          localStorage.setItem(that.localStorageKey, dataUrl);
          console.log("Zapamiętałem obrazek w localStorage; key: " + that.localStorageKey);
          img.src=dataUrl;

        }
      )
    }
};

ImageLoader.prototype.clearLocalStorage = function() {
    localStorage.removeItem(this.localStorageKey);
    console.log("Wyczyściłem localStorage; klucz: " + this.localStorageKey);
};
