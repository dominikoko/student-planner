
function hasClass(ele, cls) {
  return (' ' + ele.className + ' ').indexOf(' ' + cls + ' ') > -1;
}

function kalendarzOnButtonsClicked(ele) {
  var activeClassName = 'active';
  var parent = ele.parentNode;

  if (hasClass(parent, activeClassName)) {
    parent.classList.remove(activeClassName);

  } else {
    parent.classList.add(activeClassName);
  }
}

var Add2Calendar = function(eventData) {


  this.mergeObj = function(obj1, obj2) {
    var result = {}

    for (var attr in obj1) { result[attr] = obj1[attr]; }
    for (var attr in obj2) { result[attr] = obj2[attr]; }

    return result;
  };
  
  this.formatTime = function(date) {
    return date.toISOString().replace(/-|:|\.\d+/g, '');
  };
    
  
  this.isValidEventData = function(eventData) {
    if (this.isSingleEvent) {
      // HACK
      return true;

    } else {
      if (eventData.length > 0) {
        // HACK
        return true;
      }
    }

    return false;
  };

  this.isObjectType = function(obj, type) {
    return Object.prototype.toString.call(obj) === '[object ' + type + ']';
  };

  
  this.isDateObject = function(obj) {
    return this.isObjectType(obj, 'Date');
  };

  this.isArray = function(obj) {
    return this.isObjectType(obj, 'Array');
  };

  this.isFunc = function(obj) {
    return this.isObjectType(obj, 'Function');
  };

  
  this.serialize = function(obj) {
    var str = [];
    for (var p in obj) {
      if (obj.hasOwnProperty(p)) {
        str.push(encodeURIComponent(p) + '=' + encodeURIComponent(obj[p]));
      }
    }

    return str.join('&');
  };
  
  
  this.replaceSpecialCharacterAndSpaceWithHyphen = function(str) {
    return str.replace(/([~!@#$%^&*()_+=`{}\[\]\|\\:;'<>,.\/? ])+/g, '-').replace(/^(-)+|(-)+$/g,'');
  };

  this.getLinkHtml = function(text, url, customClass, isEnableDownloadAttr) {
    if (typeof isEnableDownloadAttr === 'undefined') { isEnableDownloadAttr = false; }
    var downloadAttr = '';

    if (isEnableDownloadAttr) {
      var fileName = 'add2Calendar-' + this.replaceSpecialCharacterAndSpaceWithHyphen(text).toLowerCase() + '-' + this.getCurrentUtcTimestamp();

      downloadAttr = ' download="' + fileName + '" ';
    }

    return '<a ' + downloadAttr + ' class="' + customClass + '" target="_blank" href="' + url + '">' + text + '</a>';
  };

  
  this.getLiHtml = function(text, url, customClass, isEnableDownloadAttr) {
    var result = '',
      isValid = false;

    // Validate
    if (url) {
      if (customClass === 'google') {
        isValid = true;

      } else {
        var urlLength = url.length;

        if (urlLength <= 20000) {
          isValid = true;

        } else {
          console.log('Url longer than 2000');
        }
      }
    }

    if (isValid) {
      var linkHtml = this.getLinkHtml(text, url, 'icon-' + customClass, isEnableDownloadAttr);
      result = '<li class="kalendarz-item kalendarz-' + customClass + '">' + linkHtml + '</li>';
    }

    return result;
  };

  this.getCurrentUtcTimestamp = function() {
    return Date.now();
  };

  /*Google
  */

  this.updateGoogleUrl = function() {
    if (this.isSingleEvent) {
      var startDate = this.formatTime(new Date(this.eventData.start)),
        endDate = this.formatTime(new Date(this.eventData.end));

      var googleArgs = {
        'text'      : (this.eventData.title || ''),
        'dates'     : startDate + '/' + endDate,
        'location'  : (this.eventData.location || ''),
        'details'   : (this.eventData.description || ''),
        'sprop'     : ''
      };

      this.googleUrl = 'https://www.google.com/calendar/render?action=TEMPLATE&' + this.serialize(googleArgs);
    }
  }

  this.getGoogleUrl = function() {
    return this.googleUrl;
  };

  this.getGoogleLiHtml = function() {
    return this.getLiHtml('Kalendarz Google', this.googleUrl, 'google', this._blank);
  };

  this.openGoogle = function() {
    window.open(this.googleUrl);
  };

  /* Widget

  */
  
  this.getEventListHtml = function() {
    var html = '<ul class="kalendarz-list">';

    html += this.getEventListItemsHtml();
    html += '</ul>';

    return html;
  };

  this.getEventListItemsHtml = function() {
    var html = '';

    html += this.getGoogleLiHtml();

    return html;
  };

  this.getWidgetNode = function() {
    var html = '<span class="kalendarz-btn" onclick="kalendarzOnButtonsClicked(this);">'
    html += this.getWidgetBtnText();
    html += '</span>';
    html += this.getEventListHtml();

    var result = document.createElement('div');
    result.innerHTML = html;
    result.className = this.textDomain;
    result.id = this.textDomain;

    return result;
  };

  this.getWidgetBtnText = function() {
    var result = (this.option.buttonText)
      ? this.option.buttonText
      : this.add2calendarBtnTextMap[this.option.lang];

    return result;
  };

  /*API
  */

  this.createWidget = function(selector, cb) {
    this.selector = selector;
    this.eWidget = document.querySelector(selector);

    var node = this.getWidgetNode();
    this.eWidget.appendChild(node);

    if (this.isFunc(cb)) {
      cb();
    }
  };

  this.setOption = function(option) {
    this.userOption = option;
    this.option = this.mergeObj(this.defaultOption, this.userOption);
  };

  this.resetOption = function() {
    this.option = this.defaultOption;
  };



  /*Zmienne globalne
  */
 
  this.textDomain = 'kalendarz';
  this.add2calendarBtnTextMap = {
    'pl': 'Dodaj do kalendarza',
	'en': 'Add ',
  };

  this.isSingleEvent;

  this.eventData;

  this.selector;
  this.eWidget;


  this.defaultOption;
  this.userOption;
  this.option;

  this.googleUrl;
 
  /*Inicjalizacja
  */

  this.updateCalendar = function() {
    this.updateGoogleUrl();
  };

  this.init = function(eventData) {
    this.isSingleEvent = ! this.isArray(eventData);

    if (! this.isValidEventData(eventData)) {
      console.log('Event data format is not valid');

      return false;
    }

    this.eventData = eventData;
    
    this.selector = '';
    this.eWidget = null;

    this.defaultOption = {
      lang: 'pl',
      buttonText: '',
    };
    this.option = this.defaultOption;

    this.googleUrl = '';

    this.updateCalendar();
  };

  this.init(eventData);
};
