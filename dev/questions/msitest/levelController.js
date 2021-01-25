
app.controller("levelController", function($scope, $timeout, $interval, $window) {
    var audioContext = null;
    var meter = null;
    $scope.sensitivity = 1;
    $scope.opacity = 1;
    $scope.level = 0;
    $scope.move = 0;
    
    var lastLocation = 0;
    var sensitivity = 1;

    function startup() {
	var el = document.getElementsByTagName("body")[0];
	el.addEventListener("touchstart", handleStart, false);
	el.addEventListener("touchend", handleEnd, false);
	//    el.addEventListener("touchcancel", handleCancel, false);
	//    el.addEventListener("touchleave", handleLeave, false);
	el.addEventListener("touchmove", handleMove, false);
    }
    
    function handleStart(evt) {
	$scope.opacity = 1;
	evt.preventDefault();
	var touches = evt.changedTouches;
	
	lastLocation = touches[0].pageY; 
	sensitivity = $scope.sensitivity;
    }
    
    function handleMove(evt) {
	$scope.opacity = 1;
	evt.preventDefault();
	var touches = evt.changedTouches;
	console.log((touches[0].pageY - lastLocation)/$window.innerHeight*100);
	sensitivity = (Math.max(1, sensitivity-(touches[0].pageY - lastLocation)/$window.innerHeight*100));
	lastLocation = touches[0].pageY; 
	$scope.sensitivity = Math.ceil(sensitivity);
    }

    function handleEnd(evt) {
	$timeout(function(){$scope.opacity = 0;}, 2000);
    }

    document.onkeydown = function(e) {
	$scope.opacity = 1;
	switch (e.keyCode) {
        case 37:
	    $scope.sensitivity = 1;
            break;
        case 38:
            $scope.sensitivity += 1;	    
            break;
        case 40:
            $scope.sensitivity -= 1;
	    $scope.sensitivity = Math.max($scope.sensitivity, 1);
            break;
	}
	// should pop and flush timeouts
	$timeout(function(){$scope.opacity = 0;}, 2000);
    };
    
    
    // monkeypatch Web Audio
    window.AudioContext = window.AudioContext || window.webkitAudioContext;
    
    // grab an audio context
    audioContext = new AudioContext();

    // Attempt to get audio input
    try {
        // monkeypatch getUserMedia
        navigator.getUserMedia = 
            navigator.getUserMedia ||
            navigator.webkitGetUserMedia ||
            navigator.mozGetUserMedia;

        // ask for an audio input
        navigator.getUserMedia(
            {
		"audio": {
                    "mandatory": {
			"googEchoCancellation": "false",
			"googAutoGainControl": "false",
			"googNoiseSuppression": "false",
			"googHighpassFilter": "false"
                    },
                    "optional": []
		},
            }, gotStream, didntGetStream);
    } catch (e) {
        alert('getUserMedia threw exception :' + e);
    }
    
    function didntGetStream() {
	alert('Stream generation failed.');
    }
    
    var mediaStreamSource = null;
    function gotStream(stream) {
	// Create an AudioNode from the stream.
	mediaStreamSource = audioContext.createMediaStreamSource(stream);

	// cw version: Create a new volume meter and connect it.
	meter = createAudioMeter(audioContext);
	// analyser node version:
	//	meter = createAnalyserMeter(audioContext);

	mediaStreamSource.connect(meter);
	// kick off the visual updating
	update();
    }
    
    
    var update = function(){
	var alpha = 0.3;
	// analyser node version:
	//	meter.getVolume();
	
	$scope.level = $scope.level*alpha+(1-alpha)*meter.volume*$scope.sensitivity;
	$scope.logLevel = Math.max(0, 50+Math.ceil(20*Math.log10($scope.level)));
	$timeout(function(){update()}, 50);
    }

    startup();
    $timeout(function(){$scope.opacity = 0;}, 5000);
    // update();
});
