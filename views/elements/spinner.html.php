<svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="220" height="220">
	<linearGradient id="grad1" x1="100%" y1="0%" x2="0%" y2="100%">
		<stop offset="0%" style="stop-opacity:0.7" />
		<stop offset="100%" style="stop-opacity:1" />
	</linearGradient>
	<linearGradient id="grad2" x1="100%" y1="100%" x2="0%" y2="0%">
		<stop offset="0%" style="stop-opacity:0.4" />
		<stop offset="100%" style="stop-opacity:0.7" />
	</linearGradient>
	<linearGradient id="grad3" x1="0%" y1="100%" x2="100%" y2="0%">
		<stop offset="0%" style="stop-opacity:0.1" />
		<stop offset="100%" style="stop-opacity:0.4" />
	</linearGradient>
	<linearGradient id="grad4" x1="0%" y1="0%" x2="100%" y2="100%">
		<stop offset="66%" style="stop-opacity:0" />
		<stop offset="100%" style="stop-opacity:0.1" />
	</linearGradient>
	<g>
		<circle cx="10" cy="110" r="10" fill="black" ></circle>
		<path id="quadcurve1" d="M10,110 c0,-55 45,-100 100,-100" stroke="url(#grad1)" stroke-width="20" fill="none">
		</path>
		<path id="quadcurve1" d="M110,10 c55,0 100,45 100,100" stroke="url(#grad2)" stroke-width="20" fill="none">
		</path>
		<path id="quadcurve1" d="M210,110 c0,55 -45,100 -100,100" stroke="url(#grad3)" stroke-width="20" fill="none">
		</path>
		<path id="quadcurve1" d="M110,210 c-55,0 -100,-45 -100,-100" stroke="url(#grad4)" stroke-width="20" fill="none">
		</path>
		<animateTransform attributeName="transform" attributeType="XML"
						  type="rotate" from="360, 110, 110" to="0,110,110"
						  begin="0s" dur="2s" fill="freeze" repeatCount="indefinite">
		</animateTransform>
	</g>
</svg>