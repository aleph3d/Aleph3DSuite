var Server;



        function log( text ) {
            $log = $('#log');
            //Add text to log
            $log.append(($log.val()?"\n":'')+text);
            //Autoscroll
            $log[0].scrollTop = $log[0].scrollHeight - $log[0].clientHeight;
        }

        function send( text ) {
            Server.send( 'message', text );
        }
	function fooWSChatConnect() {
        $(document).ready(function() {
            log('Connecting...');
            Server = new FancyWebSocket('ws://'+ensSERVERip+':'+ensSERVERport);

            $('#message').keypress(function(e) {
                if ( e.keyCode == 13 && this.value ) {
                    log( 'You: ' + this.value );
                    send( this.value );

                    $(this).val('');
                }
            });

            //Let the user know we're connected
            Server.bind('open', function() {
                log( "Connected." );
            });

            //OH NOES! Disconnection occurred.
            Server.bind('close', function( data ) {
                log( "Disconnected." );
            });

            //Log any messages sent from server
            Server.bind('message', function( payload ) {
                log( payload );
            });

            Server.connect();
        });
        }
        function fooWSRegister() {
        localVarUserName = document.getElementById('regusername').value;
        localVarPassword = document.getElementById('regpassword1').value;
        localVarPasswordAgain = document.getElementById('regpassword2').value;
        if(localVarPassword == localVarPasswordAgain) {
        	send('/##register::'+comKEY+'::'+localVarUserName+'::'+localVarPassword);
        }
        else {
        	SYSmessage('error','Your Passwords do not match! Please try again.');
        }
        }
