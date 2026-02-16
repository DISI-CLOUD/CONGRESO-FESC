<div class="container d-flex flex-row mb-3 d-sm-block d-md-block mt-5 ">
    <div class="col-6 d-block-md d-block-sm">
        <h2>Contacto</h2>
        <span class="texto-sm">En caso de tener una duda, sugerencia u opinión
            acerca del Congreso contacta a través del siguiente medio:
        </span>
        <div class="d-flex flex-row">
            <div class="col-xl-3 col-lg-3 col-md-3 d-none d-md-block circulo"></div>
            <div class="col-xl-9 col-lg-9 col-md-9 d-sm-block col-sm-12">
                <?php
                //Trae el congreso más reciente
                $consCongreso = "SELECT * FROM congreso WHERE id_congreso=(SELECT MAX(id_congreso) FROM congreso);";
                $resCongreso = mysqli_query($conexion, $consCongreso);
                $fetchCongreso = mysqli_fetch_assoc($resCongreso);
                // Traer usuario y contraseña
                $correoCongreso = $fetchCongreso['correo_congreso'];
                $hashContra = $fetchCongreso['contra_congreso'];
                ?>
                <span class="texto-sm"><?php echo strtolower($correoCongreso); ?></span>
            </div>
        </div>
    </div>

    <div class=" col-xl-6 col-lg-12 d-none d-lg-block ">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3756.5259176186373!2d-99.18976938469959!3d19.690221237493482!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1f54156948569%3A0x9ef349d975d1150f!2sFES%20Cuautitl%C3%A1n%20UNAM%20Campus%20IV!5e0!3m2!1ses!2smx!4v1666125470718!5m2!1ses!2smx" width="450" height="330" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</div>
