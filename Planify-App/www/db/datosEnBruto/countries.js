import fs from "fs";
import https from "https";

const url = "https://download.geonames.org/export/dump/countryInfo.txt";

https.get(url, res => {
  let data = "";
  res.on("data", chunk => data += chunk);
  res.on("end", () => {
    const lines = data.split("\n"); // <--- corregido
    const countries = lines
      .filter(line => line && !line.startsWith("#"))  // ignorar comentarios
      .map((line, index) => {
        const parts = line.split("\t"); // tabs reales
        return {
          id: index + 1,
          iso2: parts[0],
          iso3: parts[1],
          isoNumeric: parts[2],
          fips: parts[3],
          name: parts[4],
          capital: parts[5],
          areaKm2: parts[6] ? parseFloat(parts[6]) : null,
          population: parts[7] ? parseInt(parts[7], 10) : null,
          continent: parts[8],
          tld: parts[9],
          currencyCode: parts[10],
          currencyName: parts[11],
          phone: parts[12],
          postalCodeFormat: parts[13],
          postalCodeRegex: parts[14],
          languages: parts[15] ? parts[15].split(",") : [],
          geonameId: parts[16],
          neighbours: parts[17] ? parts[17].split(",") : []
        };
      });

    fs.writeFileSync("countries.json", JSON.stringify(countries, null, 2));
    console.log("countries.json creado con", countries.length, "países");
  });
}).on("error", err => {
  console.error("Error al descargar el archivo:", err.message);
});
