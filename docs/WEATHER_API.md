# Weather API

Esta aplicación incluye un controlador para consultar el tiempo en distintas ciudades.

## Endpoint de Porcuna

```
GET /api/weather/porcuna
```

Devuelve un objeto JSON con la información meteorológica obtenida desde wttr.in.

### Ejemplo de respuesta

```json
{
  "current_condition": [
    {
      "temp_C": "20",
      "weatherDesc": [{"value": "Partly cloudy"}]
    }
  ]
}
```

Para probarlo en local, levanta el servidor de Laravel y visita `http://localhost:8000/api/weather/porcuna`.
