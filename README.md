## Laravel api  for creating Questionaires with Passport authentication

### Endpoints:

 - Register user: `api/register`, method is "POST". Has these fields: name, email, password, password_confirmation. Returned values is user object with access token.

 - Login user: `api/login`, method is "POST". Has these fields: email and password. Needs generated token.

#### Questionaires

 - `/getQuestionaires`, method is "GET". Gets all questionaires with associated questions and user whom created it.
 - `/getQuestionaire`, method is "GET". Gets specific questionaire with associated questions and user whom created it. 
 Need to pass json with parameter `questionaire_id`.
 ```
    {
        "questionaire_id": 1,
    }
```

 - `/setQuestionaire`, method is "POST". json looks like this:
 ```
    {
        "name": "Prvi",
        "description": "Prvi",
        "user_id": 2,
        "status_id": 1,
        "questions": [
            5,
            6
        ]
    }
```

#### Notice: Array of associated questions are set in the order of array indexes of said array. Members are id's of sid questions in their respective table. If there is no questions under these id's, error would be thrown.

 - `/updateQuestionaire`, method is "PATCH". It updates said questionaire. 
 Json structure:

 ```
    {
        "questionaire_id": 1,
        "name": "Prvix1",
        "description": "UnoX",
        "user_id": 1,
        "status_id": 1,
        "questions": [
            5,
            2
        ]
    }
```

#### Notice: Array of associated questions will overwrite previous one. You can always omit updating questions associated. And associate questions separately.

 - `/deleteQuestionaire`, method is "DELETE". Deletes specific questionaire. Json structure:
 ```
    {
        "questionaire_id": 1
    }
```

#### Questions

 - `/getQuestions`, method is "GET". Gets all the questions.
 - `/setQuestion`, method is "POST". Creates questions.
 Json structure: 
 ```
    {
        "name": "Koliko uglova ima trougao",
        "description": "Trougao",
        "status_id": 1,
        "field_type": 2
    }
```

 - `/getQuestion`, method is "GET". Gets specific question with associated answer. 
 - `/updateQuestion`, method is "PATCH". Updates specific question.
  Json structure: 
  ```
    {
        "question_id": 2,
        "name": "Hemijski izraz za vodu",
        "description": "VodaX",
        "status_id": 1,
        "field_type": 1
    }
```

 - `/deleteQuestion`, method is "DELETE". Deletes specific question.
 - `/getAnswers`, method is "GET". Gets all the answers with their associated questions.

#### Answers

 - `/setAnswer`, method is "POST". Creates new answer. Needs to be associated with question.
Json structure: 
 ```
    {
        "answer": "Crvene je boje.",
        "question_id": 1
    }
```

 - `/getAnswer`, method is "GET". Gets specific answer.
Json structure:
 ```
    {
        "answer_id": 2
    }
```

 - `/updateAnswer`, method is "PATCH". Updates specific answer. 
Json structure:
  ```
    {
        "answer": "Vodica",
        "answer_id": 2,
        "question_id": 2
    }
```

 - `/deleteAnswer`, method is "DELETE". Deletes specific answer. 
Json structure:
```
    {
        "answer_id": 2
    }
```

#### Helper

 - `/connect`, method is "PATCH". Updates specific questionaire with specific(one at a time) question. 
 Json structure:
 ```
    {
        "questionaire_id": 2,
        "question_id": 2
    }
```

#### Status

 - `/getStatuses`, method is "GET". Gets all statuses.
 - `/setStatus`, method is "POST". Creates new status. Statuses determine if questionaire or question is accessible to use by all or just for private use for it's creator. If it's "free" or "private".
Json structure:
```
    {
        "name": "custom"
    }
```

 - `/getStatus`, method is "GET". Gets specific status.
Json structure:
```
    {
        "status_id": 1
    }
```

 - `/updateStatus`, method is "PATCH". Updates specific status.
Json structure:
```
    {
        "status_id": 3,
        "name": "customFieldUpdate"
    }
```

 - `/deleteStatus`, method is "DELETE". Delete specific status.
Json structure:
```
    {
        "status_id": 3
    }
```

#### Roles

 - `/getRoles`, method is "GET". Gets all roles.
 - `/setRole`, method is "POST". Creates a new role.
Json structure:
```
    {
        "user_id": 2,
        "name": "admin"
    }
```

 - `/getRole`, method is "GET". Get specific role.
Json structure:
```
    {
        "role_id": 1
    }
```

 - `/updateRole`, method is "PATCH". Updates specific role.
Json structure:
```
    {
        "role_id": 3,
        "name": "adminatrix"
    }
```

 - `/deleteRole`, method is "DELETE". Delete specific role.
Json structure:
```
    {
        "role_id": 3
    }
```

#### Field types

 - `/getFieldTypes`, method is "GET". Gets all field types. Types can be: radio, checkbox, or select-option.
 - `/setFieldType`, method is "POST". Creates a new field type.
Json structure:
```
    {
        "user_id": 3,
        "name": "customType"
    }
```

 - `/getFieldType`, method is "GET". Get specific field type.
Json structure:
```
    {
        "field_type": 1
    }
```

 - `/updateFieldType`, method is "PATCH". Updates specific field type.
Json structure:
```
    {
        "name": "radioX"
    }
```

 - `/deleteFieldType`, method is "DELETE". Delete specific field type.
Json structure:
```
    {
        "role_id": 3
    }
```

#### Right answers

 - `/getRightAnswers`, method is "GET". Gets all the right answers.

 - `/setRightAnswer`, method is "POST". Creates right answer of avaliable answers.
Json structure:
```
    {
        "user_id": 2,
        "question_id": 2,
        "answer_id": 4
    }
```

 - `/getRightAnswer`, method is "GET". Gets specific right answers.
Json structure:
```
    {
        "rightAnswer": 4
    }
```

 - `/updateRightAnswer`, method is "PATCH". Updates specific right answer.
Json structure:
```
    {
        "rightAnswer_id": 4,
        "user_id": 2,
        "question_id": 5
    }
```

 - `/deleteRightAnswer`, method is "DELETE". Deletes specific right answer.
Json structure:
```
    {
        "rightAnswer": 4
    }
```

##### Addendum - Postman collection with all the calls:

[Collection](https://www.getpostman.com/collections/f6f11f8cac591b3137dd)


