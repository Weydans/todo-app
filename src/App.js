import '../node_modules/bootstrap/dist/css/bootstrap.min.css';
import '../node_modules/jquery/dist/jquery.min.js';
import '../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js';
import '../node_modules/font-awesome/css/font-awesome.min.css';

import React from 'react';

import Routes from './Routes/Routes.jsx';

function App() {
	return (
		<div className="content">
			<Routes />
		</div>
	);
}

export default App;
