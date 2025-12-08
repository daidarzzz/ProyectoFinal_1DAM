import fs from "fs";

const data = fs.readFileSync("cities15000.txt", "utf8");
const lines = data.split("\n");

const cities = lines.map((line, index) => {
  const parts = line.split("\t");
  if (parts.length < 15) return null;

  return {
    id: index + 1, // ID único por ciudad
    name: parts[1],
    country: parts[8],
    lat: parseFloat(parts[4]),
    lon: parseFloat(parts[5]),
    population: parseInt(parts[14], 10)
  };
}).filter(Boolean);

// Contar países distintos
const countrySet = new Set(cities.map(city => city.country));
console.log("Número de países distintos:", countrySet.size);

fs.writeFileSync("cities.json", JSON.stringify(cities, null, 2));
console.log("cities.json creado con", cities.length, "ciudades");
