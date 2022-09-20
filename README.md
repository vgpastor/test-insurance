# Test data parser
Repository to show my knowledge of symfony.

## Technical case study – Connections
### Background
In Car Insurance, the prices for the tariffs are very variable and depend on a lot of parameters. We
cannot calculate prices ourselves, so we need to connect to each insurance to ask for prices.
Your task is to take the data provided by our user and then prepare an API call to the FOO insurance
to receive prices for car insurance tariffs.

### Challenges
- Mapping: We have our own format for the input parameters, and each of the insurances
have their own. Sometimes, a mapping is not just mapping the key, but also mapping the
value or even combining values.
- Creating the XML: Should you use SimpleXML to build the request, or another XML
framework, or is there an alternative? Find a good solution and have arguments for and
against your choice.
### Task
#### Data gathering
Create a command that will read the input parameters and echo the XML. You could read the input
from a file and output to the console or do it in another way – whatever is easiest for you.

There is no exact specification of how to create, try to infer from the example XML and the
parameters what should be mapped where.

The goal is not to have every value mapped; we expect at least the mappings given in the chapter
“Mappings”.

The format for the input can be defined by you - p.ex. JSON.
You have free choice of frameworks/libraries.

Acceptance criteria:
- You are prepared to explain your architectural decisions, in key decisions having more than
one possible solution and explaining the pros and cons of your choice.
- The command works and converts the parameters to an XML.
- The mapping is implemented in a way that the product manager can double check it.
- You assure through automated test that the mapping is correct in all edge cases.
- There is error handling for missing / wrong input.
- You can create a request for both sets of input parameters and receive sensible output (Not
everything mapped, but what is mapped should make sense)

## Steps
- Prepare environment base in symfony 6 adding phpunit and phpstan
- Create a command to read the input parameters and echo the XML
- Create a service to map the input parameters to internal class, possibility to add more mappings
- Create a service to manage the output based in insurance company, possibility to add more companies

## Next steps
- Integrate more validations in the data input
- Adding a listener to read queued data.

## Points to analyze
- The data of the insurance inside the xml, i don't know the significance of each field, so i can't decide wich it's the better strategy to map the data.
- How the real are received and the format of the them.
