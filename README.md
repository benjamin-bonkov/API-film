# API Documention

# Endpoints

GET /v1/films/@id
	return movie whose id is @id

GET /v1/films
	return all the movie

GET /v1/films/search?field=value&field1=value1
	return films whose field's value is value

POST /v1/films
	create film

PUT /v1/films/@id
	update movie whose id is @id

DELETE /v1/films/@id = FilmsController->actionDelete
	delete movie whose id is @id