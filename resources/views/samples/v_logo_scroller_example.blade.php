<style>
                .sponsor-slider-container {
                    display: flex;
                    align-items: center;
                    overflow: hidden;
                }

                .sponsor-slider {
                    height: 100px;
                    margin: auto;
                    position: relative;
                    white-space: nowrap;
                }

                .sponsor-slider .slide-track {
                    display: inline-block;
                    animation: scroll 10s linear infinite;
                    animation-fill-mode: forwards;
                }

                .sponsor-slider .item-slide {
                    display: inline-block;
                    width: 250px;
                    margin-right: -5px; /* Remove the margin */
                }

                .sponsor-slider .item-slide img {
                    height: 100px;
                    width: 250px;
                }

                @keyframes scroll {
                    0% {
                        transform: translateX(0);
                    }

                    100% {
                        transform: translateX(calc(-250px * var(--slide-count) / 2.01));
                        /* Modify this line */
                    }

                }
            </style>

            <div class="sponsor-slider-container">
                <div class="sponsor-slider">
                    <div class="slide-track" style="--slide-count: 0;">
                        <!-- Slide content goes here -->
                        <div class="item-slide">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/1.png" alt="" draggable="false" />
                        </div>
                        <div class="item-slide">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/2.png" alt="" draggable="false" />
                        </div>
                        <div class="item-slide">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/3.png" alt="" draggable="false" />
                        </div>
                        <div class="item-slide">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/4.png" alt="" draggable="false" />
                        </div>
                        <div class="item-slide">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/5.png" alt="" draggable="false" />
                        </div>
                        <div class="item-slide">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/6.png" alt="" draggable="false" />
                        </div>
                        <div class="item-slide">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/7.png" alt="" draggable="false" />
                        </div>
                        <div class="item-slide">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/1.png" alt="" draggable="false" />
                        </div>
                        <div class="item-slide">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/2.png" alt="" draggable="false" />
                        </div>
                        <div class="item-slide">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/3.png" alt="" draggable="false" />
                        </div>
                        <div class="item-slide">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/4.png" alt="" draggable="false" />
                        </div>
                        <div class="item-slide">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/5.png" alt="" draggable="false" />
                        </div>
                        <div class="item-slide">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/6.png" alt="" draggable="false" />
                        </div>
                        <div class="item-slide">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/7.png" alt="" draggable="false" />
                        </div>
                    </div>
                </div>
            </div>

            <script>
                // JavaScript to calculate the number of slide items
                const slideTrack = document.querySelector('.slide-track');
                const slideItems = document.querySelectorAll('.item-slide');
                const slideCount = slideItems.length;

                slideTrack.style.setProperty('--slide-count', slideCount);
            </script>
