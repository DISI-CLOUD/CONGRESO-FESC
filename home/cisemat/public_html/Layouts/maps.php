<div class="container w-60 pt-4 d-block-sm d-block-md mb-5 mt-4">
    <div class="row align-items-stretch">
        <div class="col-md-7 col-lg-7 col-sm-12">
            <div class="mt-3 mb-3">
                <h2>Ubicación de la sede</h2>
            </div>
            <div class=" border border-success p-2 border-opacity-10 borde">
                <span class="texto-sm ">Facultad de Estudios Superiores Cuautitlán
                    Km 2.5 carretera Cuautitlán-Teoloyucan, San Sebastián Xhala, Cuautitlán Izcalli,
                    Estado de México.
                    C.P. 54714.
                </span>
            </div> <br>
            <h2 class="fw-bold">Contacto</h2>
            <div class="mb-2">
                <span class="texto-sm">En caso de tener una duda, sugerencia u opinión
                    acerca del Congreso contacta a través del siguiente medio:</span>
            </div>
            <div class="mb-4 ">
                <div class="row g-0 ">
                    <div class="col-1">
                        <div class="circulo d-none d-md-block">
                        </div>
                    </div>
                    <?php
                    //Trae el congreso más reciente
                    $consCongreso = "SELECT * FROM congreso WHERE id_congreso=(SELECT MAX(id_congreso) FROM congreso);";
                    $resCongreso = mysqli_query($conexion, $consCongreso);
                    $fetchCongreso = mysqli_fetch_assoc($resCongreso);
                    // Traer usuario y contraseña
                    $correoCongreso = $fetchCongreso['correo_congreso'];
                    $hashContra = $fetchCongreso['contra_congreso'];
                    ?>
                    <div class="col-11">
                        <div class=" pt-2 p-2 ">
                            <p class="texto-sm text-break bg-light border p-2 fw-bold borde">
                                <?php echo strtolower($correoCongreso); ?>
                            </p>
                        </div>
                    </div>
                    <div class="mb-2">
                        <span class="texto-sm">Para mayores informes comunicarse a los siguientes teléfonos:</span>
                        <ul class="texto-sm">
                            <br>
                            <li>55 56 23 18 86</li>
                            <li>55 56 23 18 90</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5 col-lg-5 d-none d-lg-block d-flex justify-content-center p-3">
            <iframe class="ms-3 w-100" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3756.5259176186373!2d-99.18976938469959!3d19.690221237493482!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1f54156948569%3A0x9ef349d975d1150f!2sFES%20Cuautitl%C3%A1n%20UNAM%20Campus%20IV!5e0!3m2!1ses!2smx!4v1666125470718!5m2!1ses!2smx" height="300" style="border:0; border-radius:10px; display:block;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</div>