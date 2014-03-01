        
        audioPlayer.addEventListener('ended', PlayNext);

        function PlayNext() {
        	audioINDEX = audioINDEX+1;
        	if(audioINDEX in audioARRAY) {
        		var nextAudio = audioARRAY[audioINDEX];
        	}
        	else {
        	audioINDEX = 0;
        		var nextAudio = audioARRAY[audioINDEX];
        	}
            audioPlayer.src = 'http://'+assetSERVERdomain+'/assets/sounds/'+nextAudio;
            audioPlayer.play();
        }
        
