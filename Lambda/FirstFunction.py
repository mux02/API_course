import json

def lambda_handler(event, context):
    username = "mux"
    password = "123"
    print("Checking account info...") # Print out to let us know that operation is start from here

    account_dict = {"mux": "123", "lack": "321", "abc": "434"} # identify our dictionary to save accounts info
    message = "Username is not correct, try again" # to print the feedback of the operation
    responseCode = 0
    
    for x in account_dict: # We are looking for the account
        if x == username:
            message = "Username existed but password is not correct"
            responseCode = 1
            
            if account_dict[username] == password:
                message = "Username existed and password is correct"
                responseCode = 2
                
    # This will return as API result
    return {
        'statusCode': 200,
        'responseCode': responseCode,
        'body': json.dumps(message)
    }
