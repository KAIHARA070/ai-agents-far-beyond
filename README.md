# AI Agents: A Step Far Beyond

<img width="375" height="288" alt="image" src="https://github.com/user-attachments/assets/7127c174-f83b-4aad-8d79-a0c416c52605" />

## 👋 Introduction

When chat-based ChatGPT was released to the public, it took us by
surprise. 

but now, AI Agents have arrived ...

It’s making us rethink the capabilities of Gen AI (narrow AI).
AI coding tools have evolved from simple autocomplete assistants to
intelligent **agents** — capable of understanding multi-file codebases,
correcting themselves, and even assisting with architectural decisions.

The very first time I encountered this experience, it felt like the
complete version of an AI Dev Tool — unlike the limited, single-file,
chat-based assistants from before.

Don’t get me wrong: chat-based tools were impressive in their time and
definitely a meaningful step forward compared to having nothing at all.
But what we have now feels like an entirely new level, not just a
version upgrade.

With tools like **GitHub Copilot GPT-4.1** and **Claude Sonnet 3.7**,
both in Agent Mode, developers are no longer just
interacting with a simple chat Q&A.
We’re starting to **collaborate** with AI in real time, like we would
with a human teammate.

I'm using GitHub's premium models, but I mostly rely on GPT-4.1 and
Claude Sonnet 3.7, both in Agent Mode. If GPT-4.1 is struggling, I switch
to Claude Sonnet 3.7 or sometimes, I use both to compare their opinions.
So, most of the points I mention in this article refer specifically to
these two models. 

I actually started with Claude Sonnet 3.7, but I noticed its slow
performance even in simple Q&A tasks. So, I tried other models, and
GPT-4.1 stood out as both capable and fast.

Of course, there are already many AI agent reviews out there, often with
detailed examples. But what follows are simply my own observations and
experiences.

## ✅ Advantages: What AI Agents Do Well

### 1. Full Project Context

Today’s AI agents don’t just autocomplete a single function — they
understand the bigger picture.

* Claude Sonnet 3.7, for example, has a context window big enough to
read and reason about most modern codebases.
* You can ask it to review an auth module, scan routing logic, or analyze
service architecture and it follows along without you repeating
yourself.

This depth of understanding results in smarter, more relevant output.

That said, it doesn’t mean these agents are fully capable or truly
autonomous. If you rely on them constantly, you’ll eventually hit their
limits: something we don't like.

---

### 2. Multi-File Capability

Older assistants struggled with code spread across files; they used a
single-file approach. But we all know code doesn't work that way, it's
almost always multi-file.

Now, when something is refactored, the AI can update all necessary files
to ensure nothing breaks as a result of the change.

And there's more:

* AI agents can follow logic, types, imports, and state across **multiple
  files and folders**.
* You can say things like: *“Refactor this module to use async/await
  instead of callbacks, and make sure the changes flow through all related
  files.”* And it will do just that.

---

### 3. Self-Correcting Code Suggestions

One of the more advanced features is how these agents **catch and fix
their own mistakes**.

During generation, they often pause, detect issues (like a logic bug or
linting error), and revise thereby ending with a mostly working version of
the code.

In my experience, Claude Sonnet 3.7 tends to do a lot of self-correcting,
while GPT-4.1 usually does not. Maybe this is because GPT-4.1 is more
efficient in coding than Claude Sonnet 3.7? But I'm not saying one is
better than the other. I switch to Claude Sonnet 3.7 when GPT-4.1 cannot
do it.

---

### 4. Session-Based Memory

These AI agents don’t have long-term memory (yet), but they do have
something powerful: **session-based memory**.

* When you ask the model to scan a set of files, it loads that info into
memory for the rest of the session.
* From that point, you can reference functions, files, or features — and
it’ll remember them accurately.
* Once the session ends, the memory resets. But during that window, it
behaves like a dev who just reviewed your entire codebase.

That’s what I call **immediate memory** — and it’s incredibly effective.

This is usually my trick: I start by instructing it to learn a specific
feature first by asking it to scan related files. 
Once it understands that, I instruct it to do the actual tasks.
Most of the time, this works well.

---

### 5. Reasoning in Both Agent Modes

In my experience, I can have a good discussion with GPT-4.1
about the code when I instruct it to discuss and not modify anything.
On the other hand, Claude Sonnet 3.7 can aggressively code even if you
specify no modifications yet, which can disrupt your line of thought at
that moment.

When Claude Sonnet 3.7 starts to lose track, I double-check its reasoning
using GPT-4.1, and I often agree with most of GPT-4.1's reasoning.

---

### 6. Verbosity in Both Agent Modes

Claude Sonnet 3.7 seems to be more verbose and
aggressive. It scans a lot, which can take a long time, even for simple
tasks. It can easily hit rate limits after just a few commands. For me,
this is a significant downside — and probably for you too.

Once again, GPT-4.1 feels more efficient to me most of the time.

But GPT-4.1, because of that nature, tends to be lazy, I guess. Many
times, even if I tell it to scan files, it will not scan but will start
discussing instead, which is of course a dangerous move. So once I sense
it is not scanning, I will ask it to scan again and request specifics,
like a function name or a certain line of code in question.

## ❌ Disadvantages: Where AI Agents Fall Short

Despite all the progress, AI agents still have rough edges — and devs
need to stay sharp.

### 1. Rate Limiting & Session Timeouts

Heavy usage can lead to throttling, slowdowns, or interruptions, especially 
when running long code reviews or repo-wide refactors. That's why I try 
to avoid Claude Sonnet 3.7 for most tasks, because it's aggressive and
tends to scan much more deeply. For moderate coding, GPT-4.1 handles it
well and is faster, so I rarely hit this limit.

---

### 2. Overconfident Assumptions and Overediting

These models often respond with **complete confidence** even when they’re
making things up.

* They may invent nonexistent functions or features.
* Misunderstand your intent and go in the wrong direction.
* You might ask for a small change, and sometimes it rewrites entire
  files, touches unrelated modules, or renames things globally — often
  creating more review work than expected.

Here’s a real example I encountered: I was trying to solve the problem
of hardcoded fixed IDs.

The first solution was to make it a constant:

`const category_id = 3`

But it didn’t stop there.

You know what GPT-4.1 did? It created a flag in the `.env` file just to
satisfy the idea that the constant could be set anytime, when all I needed
was a fixed constant !

---

### 3. Session-Based Memory Only

Session-based memory is good but it can also be the downside.

Yes, it can understand your project during a session: but once it ends,
**everything is forgotten**.

* You’ll need to prompt the agent again, so it’s best to save your previous
  prompts while you’re still attempting for it to work.
* There’s no persistent context or long-term understanding across
sessions.

Well, point 2 above also has its own good and bad.
When a session starts to feel crumpled or the AI begins hallucinating,
just start a new one.

---

### 4. Still Requires Human Review

Even with amazing code generation, AI still misses edge cases,
performance tradeoffs, or secure patterns. You still need to:

* review logic
* ensure quality
* write strong tests
* test for broken features

It gets you 80% there — but that last 20% still requires your manual effort.

## 🧑‍💻 My Typical Use Case

One of my most common workflows goes like this:

- I ask the AI about a specific feature in the codebase, say, how sales
  generation works, what modules and files are involved, and how the logic
  flows.
- The AI "learns" this in the session. Once I'm confident it understands,
  I move to the next step.
- Instead of letting the AI code on its own, I first ask it to tell me a
  detailed plan for how it would develop the new feature.
- I read through the plan, and if I'm confident it's correct, I then tell
  the AI to proceed with its detailed plan.

This approach lets me stay in control and ensures the AI is on the right
track.

When there is a problem along the way, it's really case by case. This is
where a developer's skill is tested, because we might not immediately know
where the error is coming from. But if you're skilled enough in coding,
even prompting the AI to debug will almost always lead to a resolution.

The way you guide the AI toward a solution reflects your abilities as the
dev: real coding skills are still the standard, not just "vibe
coding." Vibe coding might work for simple, personal projects, but when
things get serious, like with business logic, our skills are still
necessary.

Also, I believe that too many prompts beyond the core tasks can bombard
the AI, leading to hallucinations.

So instead of giving too many prompts in a single attempt, I do what's
mentioned above first. Once things are working and stable, I then instruct
it to apply specific coding guidelines and implement some good reviews,
say, from CodeRabbit.

## 🛠️ The Evolution of Coding: From Manual to AI Agents

Before Copilot Chat and its autocomplete feature, we did everything
manually, with a lot of help from Stack Overflow, trusted sources on the
internet, and extensive documentation. Instead of focusing on higher-level
tasks, we spent a lot of time writing code and then debugging just to get
it working. Even worse, sometimes we’d get stuck on a bug that felt
unsolvable, forcing us to create a workaround. And sometimes, we had no
idea whether we could implement a certain feature simply because it was
hard to express or implement at the code level.

With the sheer number of technologies in a modern stack, it often felt
daunting. Personally, I never really felt like I had a full grasp of
everything.

Then came Copilot Chat, which, along with autocomplete, could generate
blocks of code. This was a huge step forward, but it was still limited to
one file at a time.
In this scenario, in order to give Copilot the context, you would send it
relevant code blocks from other related files so it would know better.
Hence, we still had to manually code when developing a feature, though I
felt that about 80% of the code in each block was written by the AI.

Now, with AI agents that have codebase-wide capabilities, coding has
become more efficient than ever. It’s no longer isolated to a single file —
an agent can work across the entire project. Not only is 80% of the code
written by the AI, but agents can now complete entire tasks much faster,
as long as the dev provide the right prompt.

## 💡 Final Thoughts : Really A Whole New Experience

AI agents like Copilot GPT-4.1 and Claude Sonnet 3.7 have gone far
beyond autocompletion — they now reason, refactor, debug, and adapt. They
understand structure. They work across files. They fix themselves.

Are they perfect ? No. Are they valuable ? Absolutely. Are they real coding
companions ? For many developers … they already are, even for me.

Jobs may now require fewer developers, but highly skilled devs are still
essential for a project's success.
In the end, technology is only as powerful as the people who wield it.

True super-intelligent AGI is still on the horizon, but without the
nuances of being truly human (consciousness, creativity,
empathy, morality, imagination, etc.),
I doubt it will ever fully match human capability as a replacement.

## 📚 Further Reading

I have also written previously about pure chat-based Gen AI. If you want
to read more, check out this article:

[Generative AI Review](https://github.com/jfullstackdev/generative-ai-review)
