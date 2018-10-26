Tic-Tac-Toe

Build a distributed and event-sourced software that allows you to play Tic-Tac-Toe.
The software should allow two human players to play against each other.
To keep things as simple as possible, the players will use the command line,
and we will use simple ASCII art like

 .O.
 .X.
 ..O

to visualize the current state of the game.

Use a simple array with numeric indices from 0 to 8 to represent the field.

In the src/ folder, you will find the necessary events and commands,
plus a simple interface for an event store that you must implement.

The business rules of Tic-Tac-Toe are:

- there are nine fields, organized in a square
- there are two symbols, X and O
- X and O take turns in placing one symbol on a free field
- when either symbol has three in a row (horizontal, vertical, or diagonal), it wins
- the game is a draw when all fields are filled, but nobody has three in a row

For the purposes of this workshop, we will make the following assumptions:

- the software just supports one game, without any concurrency
- after one game has been completed, we will remove all events from the event store
- we will not use a web server, but just work at the command line

Our Tic-Tac-Toe Game has no identity. To simplify things, every component will always
load all events from the Event Store and just ignore those it is not interested in.
In real life, we would certainly define different event stream for the various

The goal of this workshop is not to build working enterprise-grade software,
but to understand Event Sourcing and related concepts and to put this into working
software in half a day.

Therefore, do not implement anything that you do not need (yet).
You should consider to write automated tests - unless you prefer debugging ;-)
Trying out test-driven development might also be an option.
The most important thing, however, is to leave your comfort zone and
really try out something new. Your goal is not to write as much software as possible,
but to learn as much as possible.

We suggest the following course of action:

1. Write code that processes the StartGame command
2. Write code that processes the PlaceSymbol command
3. Write code that visualizes the state of the game
4. Write code that detects a draw
5. Write code that detects when a symbol has won (this might look a bit ugly, don't worry)

Generally make things work first, and them make them pretty. If you have everything
covered by tests, you can always refactor.

Have fun!

P.S. If you are really quick and otherwise would get bored:
did you really cover everything by tests?

P.P.S. Everything covered by tests, and there is still time left?
Try building an additional piece of software that lets you play against the computer.
