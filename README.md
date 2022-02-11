[![N|Solid](https://s3.eu-west-2.amazonaws.com/parent-documents/assets/parent_logo.png)](http://parent.eu)

## Challenge Idea
We have two providers collect data from them in json files we need to read and make some filter operations on them to get the result


- `DataProviderX` data is stored in [DataProviderX.json]
- `DataProviderY` data is stored in [DataProviderY.json]


`DataProviderX  schema is 
```
{
  parentAmount:200,
  Currency:'USD',
  parentEmail:'parent1@parent.eu',
  statusCode:1,
  registerationDate: '2018-11-30',
  parentIdentification: 'd3d29d70-1d25-11e3-8591-034165a3a613'
}
```

we have three status for `DataProviderX` 

- `authorised` which will have statusCode `1`
- `decline` which will have statusCode `2`
- `refunded` which will have statusCode `3`


`DataProviderY  schema is 
```
{
  balance:300,
  currency:'AED',
  email:'parent2@parent.eu',
  status:100,
  created_at: '22/12/2018',
  id: '4fc2-a8d1'
}
```

we have three status for `DataProviderY` 

- `authorised` which will have statusCode `100`
- `decline` which will have statusCode `200`
- `refunded` which will have statusCode `300`


## Acceptance Criteria

Using PHP Laravel, implement this API endpoint `/api/v1/users`

- it should list all users which combine transactaions from all the available provider`DataProviderX` and `DataProviderY` )
- it should be able to filter resullt by payment providers for example `/api/v1/users?provider=DataProviderX` it should return users from DataProviderX
- it should be able to filter result three statusCode (`authorised`, `decline`, `refunded`) for example /api/v1/users?statusCode=authorised it should return all users from all providers that have status code authorised
- it should be able to filer by amount range for example `/api/v1/users?balanceMin=10&balanceMax=100` it should return result between 10 and 100 including 10 and 100
- it should be able to filer by `currency` 
- it should be able to combine all this filter together 

## The Evaluation

Task will be evaluated based on

1. Code quality
2. Application performance in reading large files 
3. Code scalability : ability to add  `DataProviderZ` by small changes
4. Unit tests coverage
5. Docker
