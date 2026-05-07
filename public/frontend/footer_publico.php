<footer style="background-color: #1a1a1a; color: #fff; padding: 40px 20px; font-family: 'Inter', sans-serif;">
    <div style="max-width: 1200px; margin: 0 auto; display: flex; flex-wrap: wrap; justify-content: space-between; gap: 30px;">
        
        <div style="flex: 1; min-width: 250px;">
            <h4 style="font-size: 11px; letter-spacing: 2px; text-transform: uppercase; margin-bottom: 20px; border-bottom: 1px solid #333; padding-bottom: 10px;">Contactos</h4>
            <p id="dinamico-contacto-1" style="font-size: 11px; color: #aaa; margin-bottom: 8px;">Cargando...</p>
            <p id="dinamico-contacto-2" style="font-size: 11px; color: #aaa;">Cargando...</p>
        </div>

        <div style="flex: 1; min-width: 250px;">
            <h4 style="font-size: 11px; letter-spacing: 2px; text-transform: uppercase; margin-bottom: 20px; border-bottom: 1px solid #333; padding-bottom: 10px;">Visítanos</h4>
            <p id="dinamico-direccion" style="font-size: 11px; color: #aaa; line-height: 1.6;">Cargando...</p>
        </div>

        <div style="flex: 1; min-width: 250px; text-align: right;">
            <h4 style="font-size: 11px; letter-spacing: 2px; text-transform: uppercase; margin-bottom: 20px; border-bottom: 1px solid #333; padding-bottom: 10px;">Sistema</h4>
            <p id="dinamico-copyright" style="font-size: 11px; color: #aaa; margin-bottom: 15px; letter-spacing: 2px;">Cargando...</p>
            
            <div style="display: flex; gap: 15px; justify-content: flex-end;">
                <a id="dinamico-fb" href="#" target="_blank" style="color: #666; display: none;"><i class="fab fa-facebook-f"></i></a>
                <a id="dinamico-tw" href="#" target="_blank" style="color: #666; display: none;"><i class="fab fa-twitter"></i></a>
                <a id="dinamico-web" href="#" target="_blank" style="color: #666; display: none;"><i class="fas fa-globe"></i></a>
            </div>
        </div>
    </div>
</footer>

<script>
    fetch('http://localhost:8000/api/footer-data')
        .then(response => response.json())
        .then(data => {
            if(data) {
                document.getElementById('dinamico-contacto-1').innerText = data.contacto_1 || '';
                document.getElementById('dinamico-contacto-2').innerText = data.contacto_2 || '';
                document.getElementById('dinamico-direccion').innerText = data.direccion || '';
                document.getElementById('dinamico-copyright').innerText = data.copyright || '';
                
                if(data.url_facebook) { document.getElementById('dinamico-fb').href = data.url_facebook; document.getElementById('dinamico-fb').style.display = 'inline-block'; }
                if(data.url_twitter)  { document.getElementById('dinamico-tw').href = data.url_twitter; document.getElementById('dinamico-tw').style.display = 'inline-block'; }
                if(data.url_web)      { document.getElementById('dinamico-web').href = data.url_web; document.getElementById('dinamico-web').style.display = 'inline-block'; }
            }
        })
        .catch(error => console.error('Error al conectar con el panel de admin:', error));
</script>