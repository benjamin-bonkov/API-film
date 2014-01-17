# API Documention

in all calls, ?token=XXXXXXXXXXXXXXXXXXXXX is necessary

#FILMS
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

#USERS
GET /v1/users
	return all users

GET /v1/users/@id
	return user whose id is @id

GET /v1/users/search?field=value&field1=value1
	return films whose field's value is value

POST /v1/users = UsersController->actionCreate
	create user

POST /v1/users/like?idFilm=X&idUser=Y
	user X like film Y

DELETE /v1/users/unlike = UsersController->actionLike
	user X unlike film Y


PUT /v1/users/@id = UsersController->actionUpdate

GET /v1/users/liked/@id
	update user whose id is @id

DELETE /v1/users/@id
	delete user whose id is @id