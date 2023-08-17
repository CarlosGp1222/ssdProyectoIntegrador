const express = require("express");
const app = express();
app.set('port', process.env.PORT || 3001);

app.use(express.json());
app.use(express.urlencoded({ extended: false }));

const employeesRoutes = app.use(require('./routes/matriculacion'));

app.listen(app.get('port'), () => {
    console.log(`Server on port http://localhost:${app.get('port')}/`);
});