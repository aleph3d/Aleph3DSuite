function init() {

				renderer = new THREE.WebGLRenderer();
				renderer.setSize(  window.innerWidth, (window.innerHeight)*0.9  );
				document.body.appendChild( renderer.domElement );
				//

				camera = new THREE.PerspectiveCamera( 70, window.innerWidth / ((window.innerHeight)* 0.9), 1, 1000 );
				camera.position.z = 400;

				scene = new THREE.Scene();

				var geometry = new THREE.CubeGeometry( 200, 200, 200 );

				var texture = THREE.ImageUtils.loadTexture( '/media/textures/aleph3d-soft-fade.png' );
				texture.anisotropy = renderer.getMaxAnisotropy();

				var material = new THREE.MeshBasicMaterial( { map: texture } );

				mesh = new THREE.Mesh( geometry, material );
				scene.add( mesh );

				//

				window.addEventListener( 'resize', onWindowResize, false );

			}

			function onWindowResize() {

				camera.aspect = window.innerWidth / ((window.innerHeight)* 0.9);
				camera.updateProjectionMatrix();

				renderer.setSize( window.innerWidth, ((window.innerHeight)* 0.9) );

			}

			function animate() {

				requestAnimationFrame( animate );

				mesh.rotation.x += 0.005;
				mesh.rotation.y += 0.01;

				renderer.render( scene, camera );

			}
